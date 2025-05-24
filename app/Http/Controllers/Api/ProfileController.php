<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\KeluargaAnggota;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        $data = $request->only([
            'nama',
            'nik',
            'no_jkn',
            'faskes_tk1',
            'faskes_rujukan',
            'no_telepon',
            'tempat_lahir',
            'tanggal_lahir',
            'alamat',
            'pekerjaan',
            'golongan_darah'
        ]);


        $user->fill($data);

        if ($user->isDirty()) {
            $user->save();
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diperbarui.',
                'user' => $user,
            ], 200);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Tidak ada perubahan data.',
                'user' => $user,
            ], 202);
        }
    }

    public function dataKeluarga(String $id)
    {
        $keluarga = KeluargaAnggota::where('anggota_id', $id)->get()
            ->makeHidden(['created_at', 'updated_at', 'deleted_at']);

        return response()->json([
            'success' => true,
            'message' => "data berhasil di dapat",
            'data' => $keluarga
        ]);
    }

    public function putData(Request $request)
    {
        $validated = $request->validate([
            'anggota_id' => 'required',
            'nik' => 'required|string|max:16',
            'nama' => 'required|string',
            'no_jkn' => 'nullable|string',
            'faskes_tk1' => 'nullable|string',
            'faskes_rujukan' => 'nullable|string',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string',
            'pekerjaan' => 'nullable|string',
            'alamat' => 'nullable|string',
            'no_telepon' => 'nullable|string',
        ]);

        $keluarga = KeluargaAnggota::updateOrCreate(
            ['nik' => $validated['nik']],
            $validated
        );

        return response()->json([
            'success' => true,
            'message' => $keluarga->wasRecentlyCreated ? 'Created' : 'Updated',
            'data' => $keluarga
        ]);
    }

    public function change(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:anggota,id',
            'password' => 'required|string',
            'new_password' => 'required|string|min:6',
        ]);

        $anggota = Anggota::find($validated['id']);

        if (!Hash::check($validated['password'], $anggota->password)) {
            return response()->json(['message' => 'Password lama salah'], 401);
        }

        $anggota->password = Hash::make($validated['new_password']);
        $anggota->save();

        return response()->json(['message' => 'Password berhasil diubah'], 200);
    }
}
