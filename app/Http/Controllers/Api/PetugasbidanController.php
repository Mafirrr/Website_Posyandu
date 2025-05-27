<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Petugas;

class PetugasbidanController extends Controller
{
    // List semua petugas
    public function index()
    {
        $petugas = Petugas::all();
        return response()->json($petugas, 200);
    }

    // Detail petugas berdasarkan ID
    public function show($id)
    {
        $petugas = Petugas::findOrFail($id);
        return response()->json($petugas, 200);
    }

    // Buat petugas baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip' => 'required|string|max:20|unique:petugas,nip',
            'nama' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:20',
            'email' => 'required|email|unique:petugas,email',
        ]);

        $petugas = new Petugas();
        $petugas->nip = $validated['nip'];
       $petugas->password = bcrypt('bidan123');
        $petugas->nama = $validated['nama'];
        $petugas->no_telepon = $validated['no_telepon'];
        $petugas->email = $validated['email'];
        $petugas->role = 'bidan';
        $petugas->save();

        return response()->json([
            'message' => 'Data petugas berhasil dibuat.',
            'data' => $petugas,
        ], 201);
    }

    // Update data petugas
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nip' => 'required|string|max:20|unique:petugas,nip,' . $id,
            'nama' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:20',
            'email' => 'required|email|unique:petugas,email,' . $id,
        ]);

        $petugas = Petugas::findOrFail($id);
        $petugas->nip = $validated['nip'];

        if (!empty($validated['password'])) {
            $petugas->password = bcrypt($validated['password']);
        }

        $petugas->nama = $validated['nama'];
        $petugas->no_telepon = $validated['no_telepon'];
        $petugas->email = $validated['email'];
        $petugas->save();

        return response()->json([
            'message' => 'Data petugas berhasil diperbarui.',
            'data' => $petugas,
        ], 200);
    }

    // Hapus petugas berdasarkan ID
    public function destroy($id)
    {
        $petugas = Petugas::findOrFail($id);
        $petugas->delete();

        return response()->json([
            'message' => 'Data petugas berhasil dihapus.'
        ], 200);
    }
}
