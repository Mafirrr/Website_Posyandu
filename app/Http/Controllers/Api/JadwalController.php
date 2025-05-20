<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Jadwal::orderByDesc('id')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string',
            'lokasi' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
            'anggota_id' => 'nullable|exists:anggota,id',
        ]);

        $jadwal = Jadwal::create($validated);
        return response()->json($jadwal, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        $validated = $request->validate([
            'judul' => 'required|string',
            'lokasi' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
            'anggota_id' => 'nullable|exists:anggota,id',
        ]);

        $jadwal->update($validated);
        return response()->json($jadwal);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return response()->json(null, 204);
    }
}
