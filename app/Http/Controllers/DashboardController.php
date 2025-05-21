<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pemeriksaan_kehamilan;
use App\Models\pemeriksaan_lab_kehamilan;
use App\Models\PemeriksaanTrimester1;
use App\Models\PemeriksaanTrimester3;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $allData = collect()
            ->merge($this->getPemeriksaanKehamilan())
            ->merge($this->getPemeriksaanTrimester1())
            ->merge($this->getPemeriksaanLab())
            ->merge($this->getPemeriksaanTrimester3());

        $merged = $allData
            ->sortByDesc(fn($item) => $item->tanggal_pemeriksaan . ' ' . $item->waktu_pemeriksaan)
            ->take(5)
            ->values();

        $chartData = $this->prepareChartData($allData);
        return view('dashboard.dashboard', compact('merged', 'chartData'));
    }

    private function getPemeriksaanKehamilan()
    {
        return pemeriksaan_kehamilan::with('kehamilan.anggota')
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
    }

    private function getPemeriksaanTrimester1()
    {
        return PemeriksaanTrimester1::with('kehamilan.anggota')
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
    }

    private function getPemeriksaanLab()
    {
        return pemeriksaan_lab_kehamilan::with('pemeriksaanKehamilan.kehamilan.anggota')
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
    }

    private function getPemeriksaanTrimester3()
    {
        return PemeriksaanTrimester3::with('kehamilan.anggota')
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
    }

    private function prepareChartData($allData)
    {
        $groupedByYear = [];

        foreach ($allData as $item) {
            $tanggal = Carbon::parse($item->tanggal_pemeriksaan);
            $year = $tanggal->format('Y');
            $month = $tanggal->format('F');

            if (!isset($groupedByYear[$year])) {
                $groupedByYear[$year] = array_fill_keys([
                    'January',
                    'February',
                    'March',
                    'April',
                    'May',
                    'June',
                    'July',
                    'August',
                    'September',
                    'October',
                    'November',
                    'December'
                ], 0);
            }

            $groupedByYear[$year][$month]++;
        }

        krsort($groupedByYear);

        $chartData = [];
        foreach ($groupedByYear as $year => $months) {
            $chartData[$year] = [
                'labels' => array_keys($months),
                'data' => array_values($months),
            ];
        }

        return $chartData;
    }
}


