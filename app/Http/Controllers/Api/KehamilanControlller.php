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
        $kehamilanList = Kehamilan::where('anggota_id', $id)
            ->orderBy('created_at', 'asc')
            ->get()
            ->makeHidden(['created_at', 'updated_at', 'deleted_at']);

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
        $pemeriksaan = PemeriksaanKehamilan::where('kehamilan_id', $id)
            ->get()
            ->makeHidden(['created_at', 'updated_at', 'deleted_at']);
        $tri1_id = $pemeriksaan->where('jenis_pemeriksaan', 'trimester1')->pluck('id')->values();
        $tri2_id = $pemeriksaan->where('jenis_pemeriksaan', 'trimester2')->pluck('id')->values();
        $tri3_id = $pemeriksaan->where('jenis_pemeriksaan', 'trimester3')->pluck('id')->values();

        $tri1 = Trimester1::with([
            'pemeriksaanRutin',
            'skriningKesehatan',
            'pemeriksaanFisik',
            'pemeriksaanAwal',
            'pemeriksaanKhusus',
            'labTrimester1',
            'usgTrimester1',
        ])->whereIn('pemeriksaan_id', $tri1_id)->get()->map(function ($item) {
            $item->makeHidden([
                'skrining_kesehatan',
                'pemeriksaan_fisik',
                'pemeriksaan_awal',
                'pemeriksaan_khusus',
                'lab_trimester_1',
                'usg_trimester_1',
                'updated_at',
                'deleted_at'
            ]);

            $item->skriningKesehatan?->makeHidden(['created_at', 'updated_at', 'deleted_at']);
            $item->pemeriksaanFisik?->makeHidden(['created_at', 'updated_at', 'deleted_at']);
            $item->pemeriksaanAwal?->makeHidden(['created_at', 'updated_at', 'deleted_at']);
            $item->pemeriksaanKhusus?->makeHidden(['created_at', 'updated_at', 'deleted_at']);
            $item->labTrimester1?->makeHidden(['created_at', 'updated_at', 'deleted_at']);
            $item->usgTrimester1?->makeHidden(['created_at', 'updated_at', 'deleted_at']);

            if ($item->pemeriksaanRutin && $item->pemeriksaanRutin->isNotEmpty()) {
                $item->pemeriksaan_rutin = $item->pemeriksaanRutin->first()->makeHidden(['created_at', 'updated_at', 'deleted_at'])->toArray();
            }

            unset($item->pemeriksaanRutin);

            return $item;
        });
        $tri2 = PemeriksaanRutin::whereIn('pemeriksaan_id', $tri2_id)->get()
            ->makeHidden(['updated_at', 'deleted_at']);
        $tri3 = Trimester3::with([
            'pemeriksaanRutin',
            'skriningKesehatan',
            'pemeriksaanFisik',
            'labTrimester3',
            'usgTrimester3',
            'rencanaKonsultasi',
        ])->whereIn('pemeriksaan_id', $tri3_id)->get()
            ->each(function ($item) {
                $item->makeHidden([
                    'skrining_kesehatan',
                    'pemeriksaan_fisik',
                    'lab_trimester_3',
                    'usg_trimester_3',
                    'rencana_konsultasi',
                    'updated_at',
                    'deleted_at'
                ]);
                $item->skriningKesehatan?->makeHidden(['created_at', 'updated_at', 'deleted_at']);
                $item->pemeriksaanFisik?->makeHidden(['created_at', 'updated_at', 'deleted_at']);
                $item->labTrimester3?->makeHidden(['created_at', 'updated_at', 'deleted_at']);
                $item->usgTrimester3?->makeHidden(['created_at', 'updated_at', 'deleted_at']);
                $item->rencanaKonsultasi?->makeHidden(['created_at', 'updated_at', 'deleted_at']);
                if ($item->pemeriksaanRutin && $item->pemeriksaanRutin->isNotEmpty()) {
                    $item->pemeriksaan_rutin = $item->pemeriksaanRutin->first()->makeHidden(['created_at', 'updated_at', 'deleted_at'])->toArray();
                }

                unset($item->pemeriksaanRutin);

                return $item;
            });
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diambil',
            'data' => [
                'pemeriksaan' => $pemeriksaan,
                'trimester1' => $tri1,
                'trimester2' => $tri2,
                'trimester3' => $tri3,
            ],
        ]);
    }
}
