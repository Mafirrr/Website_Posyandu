<?php

namespace App\Http\Controllers;

use App\Models\pemeriksaan_kehamilan;
use App\Models\pemeriksaan_lab_kehamilan;
use App\Models\PemeriksaanTrimester1;
use App\Models\PemeriksaanTrimester3;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;


class RiwayatPemeriksaanController extends Controller
{
    public function index(Request $request)
{
    $perPage = $request->input('per_page', 5);
    $search = $request->input('search');

    // Ambil semua pemeriksaan
    $pemeriksaanKehamilan = pemeriksaan_kehamilan::with('kehamilan.anggota')
        ->select('id', 'kehamilan_id', 'tanggal_periksa', 'created_at')
        ->get()
        ->map(function ($item) {
            return (object) [
                'id' => $item->id,
                'nama_anggota' => $item->kehamilan->anggota->nama ?? '-',
                'jenis_pemeriksaan' => 'Pemeriksaan Kehamilan',
                'tanggal_pemeriksaan' => $item->tanggal_periksa,
                'waktu_pemeriksaan' => $item->created_at ? $item->created_at->format('H:i:s') : '-',
            ];
        });

    $pemeriksaanTrimester1 = PemeriksaanTrimester1::with('kehamilan.anggota')
        ->select('id', 'kehamilan_id', 'tanggal_pemeriksaan', 'created_at')
        ->get()
        ->map(function ($item) {
            return (object) [
                'id' => $item->id,
                'nama_anggota' => $item->kehamilan->anggota->nama ?? '-',
                'jenis_pemeriksaan' => 'Pemeriksaan Trimester 1',
                'tanggal_pemeriksaan' => $item->tanggal_pemeriksaan,
                'waktu_pemeriksaan' => $item->created_at ? $item->created_at->format('H:i:s') : '-',
            ];
        });

    $pemeriksaanLab = pemeriksaan_lab_kehamilan::with('pemeriksaanKehamilan.kehamilan.anggota')
        ->select('id', 'pemeriksaan_kehamilan_id', 'created_at')
        ->get()
        ->map(function ($item) {
            return (object) [
                'id' => $item->id,
                'nama_anggota' => $item->pemeriksaanKehamilan->kehamilan->anggota->nama ?? '-',
                'jenis_pemeriksaan' => 'Pemeriksaan Lab Kehamilan',
                'tanggal_pemeriksaan' => $item->created_at->format('Y-m-d'),
                'waktu_pemeriksaan' => $item->created_at ? $item->created_at->format('H:i:s') : '-',
            ];
        });

    $pemeriksaanTrimester3 = PemeriksaanTrimester3::with('kehamilan.anggota')
        ->select('id', 'kehamilan_id', 'tanggal_pemeriksaan', 'created_at')
        ->get()
        ->map(function ($item) {
            return (object) [
                'id' => $item->id,
                'nama_anggota' => $item->kehamilan->anggota->nama ?? '-',
                'jenis_pemeriksaan' => 'Pemeriksaan Trimester 3',
                'tanggal_pemeriksaan' => $item->tanggal_pemeriksaan,
                'waktu_pemeriksaan' => $item->created_at ? $item->created_at->format('H:i:s') : '-',
            ];
        });

    $allPemeriksaan = $pemeriksaanKehamilan
        ->merge($pemeriksaanTrimester1)
        ->merge($pemeriksaanLab)
        ->merge($pemeriksaanTrimester3);

    // Filter berdasarkan input
if ($request->filled('search')) {
    $search = strtolower($request->input('search'));
    $allPemeriksaan = $allPemeriksaan->filter(function ($item) use ($search) {
        return strpos(strtolower($item->nama_anggota), $search) !== false;
    });
}

if ($request->filled('jenis_pemeriksaan')) {
    $jenis = $request->input('jenis_pemeriksaan');
    $allPemeriksaan = $allPemeriksaan->filter(function ($item) use ($jenis) {
        return $item->jenis_pemeriksaan == $jenis;
    });
}

    $sortedPemeriksaan = $allPemeriksaan->sortByDesc('tanggal_pemeriksaan')->values();
    $grouped = $sortedPemeriksaan->groupBy('tanggal_pemeriksaan');

    $groupedArray = $grouped->map(function ($items, $tanggal) {
        return [
            'tanggal' => $tanggal,
            'pemeriksaans' => $items,
        ];
    })->values();

    $currentPage = LengthAwarePaginator::resolveCurrentPage();

    $paginatedGrouped = new LengthAwarePaginator(
        $groupedArray->forPage($currentPage, $perPage),
        $groupedArray->count(),
        $perPage,
        $currentPage,
        ['path' => $request->url(), 'query' => $request->query()]
    );

    return view('riwayat_pemeriksaan.riwayat_pemeriksaan', [
        'paginatedGrouped' => $paginatedGrouped,
    ]);
}


    public function detail($jenis, $id)
    {
        switch ($jenis) {
            case 'Pemeriksaan Kehamilan':
                $pemeriksaan = pemeriksaan_kehamilan::with('kehamilan.anggota')->findOrFail($id);
                break;
            case 'Pemeriksaan Trimester 1':
                $pemeriksaan = PemeriksaanTrimester1::with('kehamilan.anggota')->findOrFail($id);
                break;
            case 'Pemeriksaan Lab Kehamilan':
                $pemeriksaan = pemeriksaan_lab_kehamilan::with('pemeriksaanKehamilan.kehamilan.anggota')->findOrFail($id);
                break;
            case 'Pemeriksaan Trimester 3':
                $pemeriksaan = PemeriksaanTrimester3::with('kehamilan.anggota')->findOrFail($id);
                break;
            default:
                abort(404);
        }

        return view('riwayat_pemeriksaan.detail_riwayat', compact('pemeriksaan', 'jenis'));
    }

}
