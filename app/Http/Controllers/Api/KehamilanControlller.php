<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kehamilan;
use App\Models\PemeriksaanKehamilan;
use App\Models\PemeriksaanRutin;
use App\Models\PemeriksaanTrimester1;
use App\Models\PemeriksaanTrimester3;
use App\Models\Trimester1;
use App\Models\Trimester3;
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
        $kehamilanList = Kehamilan::select('id', 'anggota_id', 'status')->where('anggota_id', $id)
            ->orderBy('created_at', 'asc')
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
        $pemeriksaan = PemeriksaanKehamilan::where('kehamilan_id', $id)->get();

        $tri1_id = $pemeriksaan->where('jenis_pemeriksaan', 'trimester1')->pluck('id')->values();
        $tri2_id = $pemeriksaan->where('jenis_pemeriksaan', 'trimester2')->pluck('id')->values();
        $tri3_id = $pemeriksaan->where('jenis_pemeriksaan', 'trimester3')->pluck('id')->values();

        $tri1 = Trimester1::with([
            'skriningKesehatan',
            'pemeriksaanFisik',
            'pemeriksaanAwal',
            'pemeriksaanKhusus',
            'labTrimester1',
            'usgTrimester1'
        ])->where('pemeriksaan_id', $tri1_id)->first();
        $tri2 = PemeriksaanRutin::where('pemeriksaan_id', $tri2_id)->get();
        $tri3 = Trimester3::with([
            'skriningKesehatan',
            'pemeriksaanFisik',
            'labTrimester3',
            'usgTrimester3',
            'rencanaKonsultasi',
        ])->where('pemeriksaan_id', $tri3_id)->get();
        $tri1->makeHidden(['created_at', 'updated_at', 'deleted_at']);
        $tri2->makeHidden(['created_at', 'updated_at', 'deleted_at']);
        $tri3->makeHidden(['created_at', 'updated_at', 'deleted_at']);
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diambil',
            'data' => [
                'id' => $id,
                'trimester1' => $tri1,
                'trimester2' => $tri2,
                'trimester3' => $tri3,
            ],
        ]);
    }
}
