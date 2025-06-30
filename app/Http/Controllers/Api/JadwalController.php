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
        return Jadwal::with('posyandu')->orderByDesc('id')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string',
            'lokasi' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'tanggal' => 'required|date',
            'yang_menghadiri' => 'required|array',
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
        return Jadwal::whereJsonContains('yang_menghadiri', (string) $id)
            ->with('posyandu')
            ->orderByDesc('id')
            ->get();
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        $validated = $request->validate([
            'judul' => 'required|string',
            'lokasi' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'tanggal' => 'required|date',
            'yang_menghadiri' => 'required|array',
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
