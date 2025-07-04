<?php

namespace App\Http\Controllers;

use App\Models\PemeriksaanKehamilan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Anggota;


class RiwayatPemeriksaanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil query dasar dengan relasi
        $query = PemeriksaanKehamilan::with(['kehamilan.anggota']);

        // Filter berdasarkan pencarian nama anggota
        if ($search = $request->search) {
            $query->whereHas('kehamilan.anggota', function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%');
            });
        }

        // Filter berdasarkan jenis pemeriksaan
        if ($jenis = $request->jenis_pemeriksaan) {
            $query->where('jenis_pemeriksaan', $jenis);
        }

        // Ambil semua data yang sudah difilter, urut berdasarkan tanggal
        $allData = $query->orderBy('tanggal_pemeriksaan', 'desc')->get();

        // Map data ke format yang sesuai
        $mapped = $allData->map(function ($item) {
            return [
                'id' => $item->id,
                'tanggal' => Carbon::parse($item->tanggal_pemeriksaan)->format('Y-m-d'),
                'nama_anggota' => $item->kehamilan->anggota->nama ?? '-',
                'jenis_pemeriksaan' => $this->getJenisPemeriksaanLabel($item->jenis_pemeriksaan),
                'waktu' => $item->created_at->format('H:i:s'),
                'jenis_pemeriksaan_raw' => $item->jenis_pemeriksaan, // untuk parameter URL
            ];
        });

        // Grouping berdasarkan tanggal
        $grouped = $mapped->groupBy('tanggal')->map(function ($items, $tanggal) {
            return [
                'tanggal' => $tanggal,
                'pemeriksaans' => $items->values(),
            ];
        })->values();

        // Pagination manual pada data yang sudah grouping
        $perPage = $request->input('per_page', 10);
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $currentItems = $grouped->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $paginatedGrouped = new LengthAwarePaginator(
            $currentItems,
            $grouped->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        // List jenis pemeriksaan untuk filter di view
        $jenisPemeriksaans = [
            'trimester1' => 'Trimester 1',
            'trimester2' => 'Trimester 2',
            'trimester3' => 'Trimester 3',
            'nifas' => 'Nifas',
        ];

        return view('riwayat_pemeriksaan.riwayat_pemeriksaan', compact('paginatedGrouped', 'jenisPemeriksaans'));
    }

    public function byAnggota(Request $request, Anggota $anggota)
    {
        $perPage          = (int) $request->input('per_page', 10);
        $search           = $request->input('search');
        $jenisPemeriksaan = $request->input('jenis_pemeriksaan');

        $query = PemeriksaanKehamilan::whereHas('kehamilan', function ($q) use ($anggota) {
            $q->where('anggota_id', $anggota->id);
        })
            ->with('kehamilan')
            ->orderByDesc('tanggal_pemeriksaan');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('catatan', 'like', "%$search%")
                    ->orWhere('jenis_pemeriksaan', 'like', "%$search%");
            });
        }
        if ($jenisPemeriksaan) {
            $query->where('jenis_pemeriksaan', $jenisPemeriksaan);
        }

        $grouped = $query->get()
            ->groupBy(fn($row) => $row->tanggal_pemeriksaan->format('Y-m-d'))   // ⬅️
            ->map(function ($items, $tgl) {
                return [
                    'tanggal'      => $tgl,
                    'pemeriksaans' => $items->map(function ($p) {
                        return [
                            'id'                => $p->id,
                            'nama_anggota'      => $p->kehamilan->anggota->nama,
                            'jenis_pemeriksaan' => $p->jenis_pemeriksaan,
                            'tanggal'           => $p->tanggal_pemeriksaan,       // ⬅️
                            'waktu'             => $p->created_at->format('H:i:s'),
                        ];
                    }),
                ];
            })
            ->values();

        $page      = LengthAwarePaginator::resolveCurrentPage();
        $slice     = $grouped->slice(($page - 1) * $perPage, $perPage)->values();
        $paginated = new LengthAwarePaginator(
            $slice,
            $grouped->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('riwayat_pemeriksaan.riwayat_pemeriksaan', [
            'paginatedGrouped' => $paginated,
            'jenisPemeriksaans' => [
                'trimester1' => 'Trimester 1',
                'trimester2' => 'Trimester 2',
                'trimester3' => 'Trimester 3',
                'nifas'      => 'Nifas',
            ],
            'anggota' => $anggota,
        ]);
    }


    public function show($id)
    {
        $pemeriksaan = PemeriksaanKehamilan::with(['kehamilan.anggota', 'posyandu'])->findOrFail($id);
        $jenis = $pemeriksaan->jenis_pemeriksaan;

        $detail = null;
        $namaAnggota = $pemeriksaan->kehamilan->anggota->nama ?? '-';

        switch ($jenis) {
            case 'trimester1':
                // Ambil data trimester 1 dengan semua relasinya
                $detail = $pemeriksaan->trimester1()->with([
                    'pemeriksaanAwal',
                    'pemeriksaanFisik',
                    'pemeriksaanKhusus',
                    'labTrimester1',
                    'skriningKesehatan',
                    'usgTrimester1',
                ])->first();

                // Ambil juga data pemeriksaan rutin
                $pemeriksaanRutin = $pemeriksaan->pemeriksaanRutin;
                break;

            case 'trimester2':
                // Untuk trimester 2, biasanya hanya ada pemeriksaan rutin
                $detail = $pemeriksaan;
                $pemeriksaanRutin = $pemeriksaan->pemeriksaanRutin;
                break;

            case 'trimester3':
                // Ambil data trimester 3 dengan semua relasinya
                $detail = $pemeriksaan->trimester3()->with([
                    'pemeriksaanRutin',
                    'posyandu',
                    'pemeriksaanFisik',
                    'labTrimester3',
                    'skriningKesehatan',
                    'rencanaKonsultasi',
                    'usgTrimester3',
                ])->first();

                // Ambil juga data pemeriksaan rutin
                $pemeriksaanRutin = $pemeriksaan->pemeriksaanRutin;
                break;

            case 'nifas':
                $detail = $pemeriksaan->nifas()->first();
                $pemeriksaanRutin = $detail;
                break;

            default:
                return response()->json(['error' => 'Jenis pemeriksaan tidak dikenal'], 400);
        }

        return view('riwayat_pemeriksaan.detail_riwayat', [
            'pemeriksaan' => $pemeriksaan,
            'detail' => $detail,
            'pemeriksaanRutin' => $pemeriksaanRutin,
            'jenis' => $this->getJenisPemeriksaanLabel($jenis),
            'namaAnggota' => $namaAnggota,
        ]);
    }

    /**
     * Convert jenis pemeriksaan ke label yang readable
     */
    private function getJenisPemeriksaanLabel($jenis)
    {
        $labels = [
            'trimester1' => 'Trimester 1',
            'trimester2' => 'Trimester 2',
            'trimester3' => 'Trimester 3',
            'nifas' => 'Nifas',
        ];

        return $labels[$jenis] ?? ucfirst($jenis);
    }
}
