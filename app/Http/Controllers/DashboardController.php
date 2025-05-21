<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pemeriksaan_kehamilan;
use App\Models\pemeriksaan_lab_kehamilan;
use App\Models\PemeriksaanKehamilan;
use App\Models\PemeriksaanTrimester1;
use App\Models\PemeriksaanTrimester3;
use App\Models\Trimester1;
use App\Models\Trimester3;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil query dasar dengan relasi
        $query = PemeriksaanKehamilan::with(['kehamilan.anggota']);



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
                'tanggal_pemeriksaan' => $item->tanggal_pemeriksaan,
                'jenis_pemeriksaan_raw' => $item->jenis_pemeriksaan, // untuk parameter URL
            ];
        });


        $grouped = $mapped->groupBy('tanggal')->map(function ($items, $tanggal) {
            return [
                'tanggal' => $tanggal,
                'pemeriksaans' => $items->values(),
            ];
        })->values();

        // List jenis pemeriksaan untuk filter di view
        $jenisPemeriksaans = [
            'trimester1' => 'Trimester 1',
            'trimester2' => 'Trimester 2',
            'trimester3' => 'Trimester 3',
            'nifas' => 'Nifas',
        ];

        $chartData = $this->prepareChartData($allData);
        return view('dashboard.dashboard', compact('mapped', 'chartData'));
    }

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
