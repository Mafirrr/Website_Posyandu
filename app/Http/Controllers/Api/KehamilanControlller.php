<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kehamilan;
use App\Models\PemeriksaanTrimester1;
use App\Models\PemeriksaanTrimester3;
use Illuminate\Http\Request;

class KehamilanControlller extends Controller
{
    public function find(string $id)
    {
        $kehamilanList = Kehamilan::select('id', 'anggota_id', 'status', 'tanggal_awal')->where('anggota_id', $id)
            ->orderBy('tanggal_awal', 'asc') // urutkan dari yang paling awal
            ->get();

        $labelPrefix = 'kehamilan ';
        $angka = ['pertama', 'kedua', 'ketiga', 'keempat', 'kelima', 'keenam', 'ketujuh', 'kedelapan', 'kesembilan', 'kesepuluh'];

        $result = $kehamilanList->map(function ($item, $index) use ($labelPrefix, $angka) {
            $item->label = $labelPrefix . ($angka[$index] ?? 'ke-' . ($index + 1));
            return $item;
        });

        return response()->json($result);
    }

    public function detail(string $id)
    {
        $tri1 = PemeriksaanTrimester1::where('kehamilan_id', $id);
        $tri3 = PemeriksaanTrimester3::where('kehamilan_id', $id);

        return response()->json([
            'trimester1' => $tri1,
            'trimester3' => $tri3,
        ]);
    }
}
