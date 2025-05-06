<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = \App\Models\Jadwal::all();
        return view('jadwal.jadwal', compact('jadwals'));
    }

    public function store(Request $request)
    {
        Jadwal::create($request->all());
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil disimpan.');
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }

    public function edit($id)
{
    $jadwal = Jadwal::findOrFail($id);
    return view('jadwal.edit', compact('jadwal'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'judul' => 'required',
        'lokasi' => 'required',
        'jam_mulai' => 'required',
        'jam_selesai' => 'required',
        'tanggal' => 'required|date',
    ]);

    $jadwal = Jadwal::findOrFail($id);
    $jadwal->update($request->all());

    return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui');
}
}
