<?php

// app/Http/Controllers/BeritaController.php

namespace App\Http\Controllers;

use App\Models\artikel;
use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = artikel::with('kategori')->paginate(10);
        return view('artikel.berita', compact('beritas'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('artikel.tambah', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'slug' => 'required|unique:beritas,slug',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('images', 'public');
        }

        artikel::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'isi' => $request->isi,
            'gambar' => $gambar,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect()->route('artikel.tambah')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(artikel $berita)
    {
        $kategoris = Kategori::all();
        return view('berita.edit', compact('berita', 'kategoris'));
    }

    public function update(Request $request, artikel $berita)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'slug' => 'required|unique:beritas,slug,' . $berita->id,
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        $gambar = $berita->gambar;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('images', 'public');
        }

        $berita->update([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'isi' => $request->isi,
            'gambar' => $gambar,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect()->route('berita.update')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(artikel $berita)
    {
        $berita->delete();
        return redirect()->route('berita.delete')->with('success', 'Berita berhasil dihapus.');
    }
}
