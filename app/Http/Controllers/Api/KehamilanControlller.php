<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kehamilan;
use App\Models\PemeriksaanTrimester1;
use App\Models\PemeriksaanTrimester3;
use Illuminate\Http\Request;

class KehamilanControlller extends Controller
{

    public function handle($id, Request $request)
    {
        $detail = $request->query('detail');

        if ($detail) {
            return $this->detail($detail);
        } else {
            return $this->find($id);
        }
    }
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

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diambil',
            'data' => $result
        ]);
    }

    public function detail(string $id)
    {
        $tri1 = PemeriksaanTrimester1::where('kehamilan_id', $id)->get();
        $tri3 = PemeriksaanTrimester3::where('kehamilan_id', $id)->get();
        $tri1->makeHidden(['created_at', 'updated_at', 'deleted_at']);
        $tri3->makeHidden(['created_at', 'updated_at', 'deleted_at']);
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diambil',
            'data' => [
                'id' => $id,
                'trimester1' => $tri1,
                'trimester3' => $tri3,
            ],
            'meta' => [
                'total_trimester1' => $tri1->count(),
                'total_trimester3' => $tri3->count(),
            ]
        ]);
    }
}
