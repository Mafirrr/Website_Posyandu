<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Petugas;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function getUser($id)
    {
        $user = Anggota::find($id);
        if ($user == null) {
            $user = Petugas::find($id);
        }
        $user->makeHidden(['created_at', 'updated_at', 'deleted_at']);
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Di dapat.',
            'user' => $user,
            'role' => ($user instanceof Anggota) ? 'anggota' : 'petugas',
        ], 200);
    }


    public function update(Request $request)
    {
        $user = auth('anggota')->user(); // gunakan guard 'anggota'

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan atau belum login.',
            ], 401);
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20',
            'no_telepon' => 'nullable|string|max:20',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'pekerjaan' => 'nullable|string|max:100',
            'golongan_darah' => 'nullable|string|max:5',
        ]);

        $user->update($request->only([
            'nama',
            'nik',
            'no_telepon',
            'tempat_lahir',
            'tanggal_lahir',
            'alamat',
            'pekerjaan',
            'golongan_darah'
        ]));

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diperbarui.',
            'user' => $user,
        ]);
    }
}
