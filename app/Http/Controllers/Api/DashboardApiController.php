<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PemeriksaanKehamilan;
use Carbon\Carbon; //

class DashboardApiController extends Controller
{
    public function grafik()
    {
        $data = PemeriksaanKehamilan::selectRaw('MONTH(tanggal_pemeriksaan) as bulan, COUNT(*) as jumlah')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $grafik = array_fill(1, 12, 0);
        foreach ($data as $d) {
            $grafik[(int) $d->bulan] = (int) $d->jumlah;
        }

        return response()->json([
            'labels' => range(1, 12),
            'data' => array_values($grafik),
        ]);
    }

public function riwayat()
{
    $data = PemeriksaanKehamilan::with('kehamilan.anggota')
        ->orderBy('tanggal_pemeriksaan', 'desc')
        ->take(50)
        ->get()
        ->map(function ($item) {
            return [
                'id' => $item->id,
                'kehamilan_id' => $item->kehamilan_id,
                'petugas_id' => $item->petugas_id,
                'tanggal_pemeriksaan' => $item->tanggal_pemeriksaan,
                'tempat_pemeriksaan' => $item->tempat_pemeriksaan,
                'jenis_pemeriksaan' => $item->jenis_pemeriksaan,
                'nama_ibu' => $item->kehamilan->anggota->nama ?? 'Tidak Diketahui',
                'waktu' => $item->created_at->format('H:i'),
            ];
        });

    return response()->json([
        'data' => $data
    ]);
}
}
