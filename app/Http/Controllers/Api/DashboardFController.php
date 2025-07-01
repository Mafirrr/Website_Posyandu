<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Anggota;

class DashboardFController extends Controller
{
    public function show($id)
    {
        $today = now()->toDateString();
        $anggotaId = $id;
        $anggota = Anggota::find($anggotaId);

        if (!$anggota) {
            return response()->json([
                'success' => false,
                'message' => 'Anggota tidak ditemukan',
            ], 404);
        }

        $jadwal = Jadwal::whereDate('tanggal', '>=', $today)
            ->whereJsonContains('yang_menghadiri',  $anggota->id)
            ->with('posyandu')
            ->orderBy('tanggal', 'asc')
            ->first();

        return response()->json([
            'success' => true,
            'data' => $jadwal,
        ]);
    }
}
