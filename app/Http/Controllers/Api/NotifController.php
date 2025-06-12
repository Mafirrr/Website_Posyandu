<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kehamilan;
use App\Models\Jadwal;
use App\Models\Anggota;

class NotifController extends Controller
{
    public function index($anggotaId)
    {
        $hasActivePregnancy = Kehamilan::where('anggota_id', $anggotaId)
            ->where('status', 'dalam_pemantauan')
            ->exists();

        if (!$hasActivePregnancy) {
            return response()->json([
                'message' => 'Anda tidak memiliki status kehamilan yang sedang dalam pemantauan',
                'data' => []
            ], 200);
        }

        $anggota = Anggota::find($anggotaId);

        if (!$anggota) {
            return response()->json([
                'message' => 'Anggota tidak ditemukan',
                'data' => []
            ], 404);
        }

        $jadwals = Jadwal::where('lokasi', $anggota->posyandu_id)
            ->with('posyandu')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'message' => 'Berhasil mengambil data jadwal',
            'data' => $jadwals
        ], 200);
    }

    public function checkStatus($anggotaId)
    {
        $kehamilan = Kehamilan::where('anggota_id', $anggotaId)
            ->where('status', 'dalam_pemantauan')
            ->first();

        if ($kehamilan) {
            return response()->json([
                'status' => 'dalam_pemantauan',
                'message' => 'Status kehamilan sedang dalam pemantauan'
            ], 200);
        }

        return response()->json([
            'status' => null,
            'message' => 'Tidak ada status kehamilan yang sedang dalam pemantauan'
        ], 200);
    }
}
