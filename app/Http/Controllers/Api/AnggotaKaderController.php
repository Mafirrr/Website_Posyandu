<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;

class AnggotaKaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all anggota data
        $anggota = Anggota::all();
        return response()->json($anggota);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'nik' => 'required|string|max:20|unique:anggota,nik',
            'nama' => 'required|string|max:255',
            'no_jkn' => 'required|string|max:13|unique:anggota,no_jkn',
            'faskes_tk1' => 'required|string|max:100',
            'faskes_rujukan' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:20',
            'golongan_darah' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
        ]);

        // Create anggota
        $anggota = new Anggota();
        $anggota->nik = $validated['nik'];
        $anggota->password = bcrypt('password123');
        $anggota->nama = $validated['nama'];
        $anggota->no_jkn = $validated['no_jkn'];
        $anggota->faskes_tk1 = $validated['faskes_tk1'];
        $anggota->faskes_rujukan = $validated['faskes_rujukan'];
        $anggota->tanggal_lahir = $validated['tanggal_lahir'];
        $anggota->tempat_lahir = $validated['tempat_lahir'];
        $anggota->pekerjaan = $validated['pekerjaan'];
        $anggota->alamat = $validated['alamat'];
        $noTelepon = $validated['no_telepon'];

        if (substr($noTelepon, 0, 2) === '08') {
            $noTelepon = '+628' . substr($noTelepon, 2);
        }

        $anggota->no_telepon = $noTelepon;
        $anggota->golongan_darah = $validated['golongan_darah'];
        $anggota->aktif = true;
        $anggota->save();

        // Return response
        return response()->json($anggota, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $anggota = Anggota::findOrFail($id);
        return response()->json($anggota);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $anggota = Anggota::findOrFail($id);

        $validated = $request->validate([
            'nik' => 'string|max:20|unique:anggota,nik,' . $id,
            'nama' => 'string|max:255',
            'no_jkn' => 'string|max:13|unique:anggota,no_jkn,' . $id,
            'faskes_tk1' => 'string|max:100',
            'faskes_rujukan' => 'string|max:100',
            'tanggal_lahir' => 'date',
            'tempat_lahir' => 'string|max:255',
            'pekerjaan' => 'string|max:255',
            'alamat' => 'string',
            'no_telepon' => 'string|max:20',
            'golongan_darah' => 'in:A+,A-,B+,B-,AB+,AB-,O+,O-',
        ]);

        $anggota->update($validated);

        return response()->json($anggota);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();

        return response()->json(['message' => 'Anggota deleted successfully.'], 200);
    }
}
