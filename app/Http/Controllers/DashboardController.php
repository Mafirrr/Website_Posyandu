<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pemeriksaan_kehamilan;
use App\Models\pemeriksaan_lab_kehamilan;
use App\Models\PemeriksaanTrimester1;
use App\Models\PemeriksaanTrimester3;

class DashboardController extends Controller
{
    public function index()
    {
        $pemeriksaanKehamilan = pemeriksaan_kehamilan::with('kehamilan.anggota')
            ->select('id', 'kehamilan_id', 'tanggal_periksa', 'created_at')
            ->get()
            ->map(function ($item) {
                return (object) [
                    'id' => $item->id,
                    'nama_anggota' => $item->kehamilan->anggota->nama ?? '-',
                    'jenis_pemeriksaan' => 'Pemeriksaan Kehamilan',
                    'tanggal_pemeriksaan' => $item->tanggal_periksa,
                    'waktu_pemeriksaan' => $item->created_at?->format('H:i:s'),
                    'hasil_pemeriksaan' => '-',
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
                    'waktu_pemeriksaan' => $item->created_at?->format('H:i:s'),
                    'hasil_pemeriksaan' => '-',
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
                    'waktu_pemeriksaan' => $item->created_at?->format('H:i:s'),
                    'hasil_pemeriksaan' => '-',
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
                    'waktu_pemeriksaan' => $item->created_at?->format('H:i:s'),
                    'hasil_pemeriksaan' => '-',
                ];
            });

        $merged = $pemeriksaanKehamilan
            ->merge($pemeriksaanTrimester1)
            ->merge($pemeriksaanLab)
            ->merge($pemeriksaanTrimester3)
            ->sortByDesc(function ($item) {
                return $item->tanggal_pemeriksaan . ' ' . $item->waktu_pemeriksaan;
            })
            ->take(5)
            ->values();

        return view('dashboard.dashboard', compact('merged'));
    }
}
