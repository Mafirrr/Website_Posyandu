<?php


namespace App\Http\Controllers;

use App\Models\artikel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
       $perPage = $request->input('per_page', 5); // Default 5 jika tidak ada
        $search = $request->input('search');
        $kategori = $request->input('kesehatan'); // variabel pakai huruf kecil sesuai konvensi

        $artikels = Artikel::when($search, function ($query, $search) {
            $query->where('judul', 'like', "%{$search}%");
        })
            ->when($kategori !== null && $kategori !== '', function ($query) use ($kategori) {
                $query->where('kategori_edukasi', $kategori); // Sesuaikan nama kolom
            })
            ->orderBy('created_at', 'desc')
              ->paginate($perPage)

            ->appends(request()->query());

        return view('artikel.berita', compact('artikels'));
    }



    public function create()
    {
        $params = [
            "title" => "Tambah Edukasi",
            "action_form" => route("berita.store"),
            "method" => "POST",
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
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif',
            'kategori_edukasi' => 'required|string|max:255',
        ]);
        $berita = new artikel();
        $berita->judul = $validated['judul'];
        $berita->slug = $validated['slug'];
        $berita->isi = $validated['isi'];

        $berita->kategori_edukasi = $validated['kategori_edukasi'];
        if ($request->hasFile('gambar')) {
            $berita->gambar = $request->file('gambar')->store('images/isiberita', 'public'); // Simpan nama file ke database
        }

        $berita->save();

        return redirect()->route('berita.index')->with('success', 'Edukasi berhasil ditambahkan.');
    }



    public function edit($id)
    {
        $params = [
            "title" => "Edit Edukasi",
            "action_form" => route("berita.update", $id),
            "method" => "put",
            "berita" =>
            artikel::find($id)
        ];
        return view('artikel.tambah', $params);
    }
    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'slug' => "required|unique:artikels,slug,$id,id",
            'isi' => 'required',
            'tanggal' => 'required|date',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori_edukasi' => 'required|string|max:255',
        ]);

        $berita =  artikel::find($id);
        $berita->judul = $validated['judul'];
        $berita->slug = $validated['slug'];
        $berita->isi = $validated['isi'];
        $berita->kategori_edukasi = $validated['kategori_edukasi'];


        if ($request->hasFile('gambar')) {
            if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
                Storage::disk('public')->delete($berita->gambar);
            }

            $berita->gambar = $request->file('gambar')->store('images/isiberita', 'public');
        }

        $berita->save();

        return redirect()->route('berita.index')->with('success', 'Edukasi berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $berita = Artikel::findOrFail($id);

        if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();
        return redirect()->route('berita.index')->with('success', 'Edukasi berhasil dihapus.');
    }
}
