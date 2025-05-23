<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Http\Request;

class PemeriksaanController extends Controller
{
    public function index(Request $request)
    {
        $nama = $request->query('nama');

        $query = Anggota::query();

        if ($nama) {
            $query->where('nama', 'like', '%' . $nama . '%');
        }

        $anggota = $query->select('id', 'nama')->get();

        return response()->json($anggota);
    }
}
