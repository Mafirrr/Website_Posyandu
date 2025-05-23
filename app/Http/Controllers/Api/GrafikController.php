<?php
// app/Http/Controllers/Api/GrafikController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;

class GrafikController extends Controller
{
    public function getBB($anggotaId): JsonResponse
    {
        $kehamilanId = DB::table('kehamilan')
            ->where('anggota_id', $anggotaId)
            ->where('status', 'dalam_pemantauan')
            ->value('id');

        if (! $kehamilanId) {
            return response()->json(['message' => 'Kehamilan aktif tidak ditemukan.'], 404);
        }

        $usgData = DB::table('trimester_1')
            ->join('usg_trimester_1', 'trimester_1.usg_trimester_1', '=', 'usg_trimester_1.id')
            ->join('pemeriksaan_kehamilan', 'trimester_1.pemeriksaan_id', '=', 'pemeriksaan_kehamilan.id')
            ->where('pemeriksaan_kehamilan.kehamilan_id', $kehamilanId)
            ->orderBy('usg_trimester_1.created_at')
            ->first([
                'trimester_1.pemeriksaan_id',
                'trimester_1.pemeriksaan_awal as pemeriksaan_awal_id',
                'usg_trimester_1.umur_kehamilan_berdasarkan_usg as minggu_usg',
                'usg_trimester_1.created_at as usg_created_at',
                'pemeriksaan_kehamilan.tanggal_pemeriksaan as pemeriksaan_date'
            ]);

        if (! $usgData) {
            return response()->json(['message' => 'Data USG trimester 1 tidak ditemukan.'], 404);
        }

        $initialWeek    = (int) $usgData->minggu_usg;
        $referenceDate  = Carbon::parse($usgData->pemeriksaan_date);

        $tinggi = DB::table('pemeriksaan_awal')
            ->where('id', $usgData->pemeriksaan_awal_id)
            ->value('tinggi_badan');

        $initialWeight = DB::table('pemeriksaan_rutin')
            ->where('pemeriksaan_id', $usgData->pemeriksaan_id)
            ->value('berat_badan');

        $imT = null;
        if ($tinggi > 0 && $initialWeight) {
            $imT = round($initialWeight / pow($tinggi/100, 2), 2);
        }

        $rutin = DB::table('pemeriksaan_rutin')
            ->join('pemeriksaan_kehamilan', 'pemeriksaan_rutin.pemeriksaan_id', '=', 'pemeriksaan_kehamilan.id')
            ->where('pemeriksaan_kehamilan.kehamilan_id', $kehamilanId)
            ->whereDate('pemeriksaan_kehamilan.tanggal_pemeriksaan', '>=', $referenceDate)
            ->get([
                'pemeriksaan_kehamilan.tanggal_pemeriksaan as tanggal',
                'pemeriksaan_rutin.berat_badan'
            ]);

        $map = [];
        $map[0] = $initialWeight;

        foreach ($rutin as $row) {
            $wkOffset = $referenceDate->diffInWeeks(Carbon::parse($row->tanggal));
            if ($wkOffset > 0 && ! isset($map[$wkOffset])) {
                $map[$wkOffset] = $row->berat_badan;
            }
        }

        $data = [];
        $maxOffset = 43 - $initialWeek;
        for ($offset = 0; $offset <= $maxOffset; $offset++) {
            if ($offset === 0) {
                $change = 0;
            } elseif (isset($map[$offset])) {
                $change = $map[$offset] - $initialWeight;
            } else {
                $change = null;
            }

            $data[] = [
                'minggu'       => $initialWeek + $offset,
                'berat_badan'  => $change,
            ];
        }

        return response()->json([
            'anggota_id'           => (int) $anggotaId,
            'IMT'                  => $imT,
            'minggu_usg'           => $initialWeek,
            'Berat_badan_awal'     => $initialWeight,
            'tanggal_pemeriksaan'  => $referenceDate->toDateString(),
            'data'                 => $data,
        ]);
    }
}
