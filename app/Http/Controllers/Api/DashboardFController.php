<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Jadwal;

class DashboardFController extends Controller
{
    public function show()
    {
        $today = now()->toDateString();
        $jadwal = Jadwal::whereDate('tanggal', '>=', $today)
            ->with('posyandu')
            ->orderBy('tanggal', 'asc')
            ->first();

        return response()->json([
            'success' => true,
            'data' => $jadwal,
        ]);
    }
}
