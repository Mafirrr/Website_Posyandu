<?php

namespace App\Http\Controllers;

use App\Models\Nifas;
use App\Models\pemeriksaan_lab_kehamilan;
use App\Models\PemeriksaanAwal;
use App\Models\PemeriksaanFisik;
use App\Models\PemeriksaanKehamilan;
use App\Models\PemeriksaanKhusus;
use App\Models\PemeriksaanLabAwal;
use App\Models\PemeriksaanRutin;
use App\Models\PemeriksaanTrimester1;
use App\Models\PemeriksaanTrimester3;
use App\Models\PemeriksaanUsgAwal;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;


class RiwayatPemeriksaanController extends Controller
{
    public function index(Request $request)
    {
        $riwayat = collect();

        // Menggabungkan semua data riwayat
        $riwayat->push(...PemeriksaanKehamilan::with('kehamilan.anggota')->get()->map(function ($p) {
            return $this->formatRiwayat($p->id, 'Pemeriksaan Kehamilan', $p->kehamilan->anggota->nama ?? '-', $p->tanggal_pemeriksaan, $p->created_at, 'kehamilan');
        }));
        $riwayat->push(...PemeriksaanFisik::with('pemeriksaan.kehamilan.anggota')->get()->map(function ($p) {
            return $this->formatRiwayat($p->id, 'Pemeriksaan Fisik', $p->pemeriksaan->kehamilan->anggota->nama ?? '-', $p->created_at->toDateString(), $p->created_at, 'fisik');
        }));
        $riwayat->push(...PemeriksaanRutin::with('pemeriksaan.kehamilan.anggota')->get()->map(function ($p) {
            return $this->formatRiwayat($p->id, 'Pemeriksaan Rutin', $p->pemeriksaan->kehamilan->anggota->nama ?? '-', $p->created_at->toDateString(), $p->created_at, 'rutin');
        }));
        $riwayat->push(...PemeriksaanKhusus::with('pemeriksaan.kehamilan.anggota')->get()->map(function ($p) {
            return $this->formatRiwayat($p->id, 'Pemeriksaan Khusus', $p->pemeriksaan->kehamilan->anggota->nama ?? '-', $p->created_at->toDateString(), $p->created_at, 'khusus');
        }));
        $riwayat->push(...PemeriksaanAwal::with('pemeriksaan.kehamilan.anggota')->get()->map(function ($p) {
            return $this->formatRiwayat($p->id, 'Pemeriksaan Awal', $p->pemeriksaan->kehamilan->anggota->nama ?? '-', $p->created_at->toDateString(), $p->created_at, 'awal');
        }));
        $riwayat->push(...PemeriksaanUsgAwal::with('pemeriksaan.kehamilan.anggota')->get()->map(function ($p) {
            return $this->formatRiwayat($p->id, 'USG Awal', $p->pemeriksaan->kehamilan->anggota->nama ?? '-', $p->created_at->toDateString(), $p->created_at, 'usg');
        }));
        $riwayat->push(...PemeriksaanLabAwal::with('pemeriksaan.kehamilan.anggota')->get()->map(function ($p) {
            return $this->formatRiwayat($p->id, 'Laboratorium Awal', $p->pemeriksaan->kehamilan->anggota->nama ?? '-', $p->created_at->toDateString(), $p->created_at, 'lab');
        }));
        $riwayat->push(...Nifas::with('anggota')->get()->map(function ($p) {
            return $this->formatRiwayat($p->id, 'Nifas', $p->anggota->nama ?? '-', $p->tanggal_pemeriksaan, $p->created_at, 'nifas');
        }));

        // ===============================
        // Filter berdasarkan pencarian
        // ===============================
        if ($search = $request->search) {
            $riwayat = $riwayat->filter(function ($item) use ($search) {
                return str_contains(strtolower($item['nama_anggota']), strtolower($search));
            });
        }

        // ===============================
        // Filter berdasarkan jenis pemeriksaan
        // ===============================
        if ($jenis = $request->jenis_pemeriksaan) {
            $riwayat = $riwayat->where('jenis_pemeriksaan', $jenis);
        }

        // ===============================
        // Grouping by tanggal
        // ===============================
        $grouped = $riwayat->sortByDesc('tanggal')->groupBy('tanggal')->map(function ($items, $tanggal) {
            return [
                'tanggal' => $tanggal,
                'pemeriksaans' => $items->values()
            ];
        })->values();

        // ===============================
        // Pagination manual
        // ===============================
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

        // ===============================
        // List jenis pemeriksaan untuk filter
        // ===============================
        $jenisPemeriksaans = [
            'Pemeriksaan Kehamilan',
            'Pemeriksaan Fisik',
            'Pemeriksaan Rutin',
            'Pemeriksaan Khusus',
            'Pemeriksaan Awal',
            'USG Awal',
            'Laboratorium Awal',
            'Nifas',
        ];

        return view('riwayat_pemeriksaan.riwayat_pemeriksaan', compact('paginatedGrouped', 'jenisPemeriksaans'));
    }

    private function formatRiwayat($id, $jenis, $nama, $tanggal, $waktu, $tipe)
    {
        return [
            'id' => $id,
            'nama_anggota' => $nama,
            'jenis_pemeriksaan' => $jenis,
            'tanggal' => $tanggal,
            'waktu' => $waktu->format('H:i:s'),
            'tipe' => $tipe,
        ];
    }

    public function show($tipe, $id)
    {
        switch ($tipe) {
            case 'kehamilan':
                $data = PemeriksaanKehamilan::with('kehamilan.anggota')->findOrFail($id);
                $jenis = 'Pemeriksaan Kehamilan';
                break;
            case 'fisik':
                $data = PemeriksaanFisik::with('pemeriksaan.kehamilan.anggota')->findOrFail($id);
                $jenis = 'Pemeriksaan Fisik';
                break;
            case 'rutin':
                $data = PemeriksaanRutin::with('pemeriksaan.kehamilan.anggota')->findOrFail($id);
                $jenis = 'Pemeriksaan Rutin';
                break;
            case 'khusus':
                $data = PemeriksaanKhusus::with('pemeriksaan.kehamilan.anggota')->findOrFail($id);
                $jenis = 'Pemeriksaan Khusus';
                break;
            case 'awal':
                $data = PemeriksaanAwal::with('pemeriksaan.kehamilan.anggota')->findOrFail($id);
                $jenis = 'Pemeriksaan Awal';
                break;
            case 'usg':
                $data = PemeriksaanUsgAwal::with('pemeriksaan.kehamilan.anggota')->findOrFail($id);
                $jenis = 'USG Awal';
                break;
            case 'lab':
                $data = PemeriksaanLabAwal::with('pemeriksaan.kehamilan.anggota')->findOrFail($id);
                $jenis = 'Laboratorium Awal';
                break;
            case 'nifas':
                $data = Nifas::with('anggota')->findOrFail($id);
                $jenis = 'Nifas';
                break;
            default:
                abort(404, 'Jenis pemeriksaan tidak dikenal');
        }

        $namaAnggota = $this->getNamaAnggota($data, $tipe);

        return view('riwayat_pemeriksaan.detail_riwayat', [
            'pemeriksaan' => $data,
            'jenis' => $jenis,
            'namaAnggota' => $namaAnggota,
        ]);
    }


    private function getNamaAnggota($pemeriksaan, $tipe)
    {
        switch ($tipe) {
            case 'nifas':
                return $pemeriksaan->anggota->nama ?? '-';
            case 'khusus':
            case 'fisik':
            case 'rutin':
            case 'awal':
            case 'usg':
            case 'lab':
                return $pemeriksaan->pemeriksaan->kehamilan->anggota->nama ?? '-';
            case 'kehamilan':
                return $pemeriksaan->kehamilan->anggota->nama ?? '-';
            default:
                return '-';
        }
    }


}
