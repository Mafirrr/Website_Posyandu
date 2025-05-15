<?php

// app/Http/Controllers/BeritaController.php

namespace App\Http\Controllers;

use App\Models\artikel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
         $search = request()->input('search');

    $artikels = Artikel::when($search, function ($query, $search) {
            $query->where('judul', 'like', "%{$search}%");
        })
        ->paginate(10);

    return view('artikel.berita', compact('artikels'));

    }

    public function create()
    {
        $params = [
            "title" => "Tambah Berita",
            "action_form" => route("berita.store"),
            "method" => "POST",
            // "kategori" => Kategori::all(),
            "berita" => (object)[
                'judul' => '',
                'slug' => '',
                'isi' => '',
                'tanggal' => '',
                'gambar' => '',
                'kategori_edukasi' => '',
            ]
        ];
        return view('artikel.tambah', $params);
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'slug' => 'required|unique:artikels,slug',
            'isi' => 'required',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori_edukasi' => 'required|string|max:255',
        ]);
        // dd(request()->all());
        $berita = new artikel(); // Pastikan model sesuai dengan tabel database
        $berita->judul = $validated['judul'];
        $berita->slug = $validated['slug'];
        $berita->isi = $validated['isi'];
        $berita->kategori_edukasi = $validated['kategori_edukasi'];
        // $berita->kategori_id = $validated['kategori_id'];

        // Cek apakah ada file gambar yang diunggah
        if ($request->hasFile('gambar')) {
            $berita->gambar = $request->file('gambar')->store('images', 'public'); // Simpan nama file ke database
        }

        $berita->save();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }



    public function edit($id)
    {
        $params = [
            "title" => "Edit Berita",
            "action_form" => route("berita.update", $id),
            "method" => "put",
            // "kategori" => Kategori::all(),
            "berita" =>
            artikel::find($id)
        ];
        return view('artikel.tambah', $params);
    }
    public function update(Request $request, $id)
    {
        // dd(request()->all());
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'slug' => "required|unique:artikels,slug,$id,id",
            'isi' => 'required',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori_edukasi' => 'required|string|max:255',
        ]);
        // dd(request()->all());
        $berita =  artikel::find($id); // Pastikan model sesuai dengan tabel database
        $berita->judul = $validated['judul'];
        $berita->slug = $validated['slug'];
        $berita->isi = $validated['isi'];
         $berita->kategori_edukasi = $validated['kategori_edukasi'];

        // Cek apakah ada file gambar yang diunggah
        if ($request->hasFile('gambar')) {
            // Hapus file lama jika ada
            if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
                Storage::disk('public')->delete($berita->gambar);
            }

            // Simpan file baru
            $berita->gambar = $request->file('gambar')->store('images', 'public');
        }

        $berita->save();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

 public function destroy($id)
{
    $berita = Artikel::findOrFail($id);

    // Hapus gambar jika ada
    if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
        Storage::disk('public')->delete($berita->gambar);
    }

    $berita->delete();
    return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus.');
}

}
