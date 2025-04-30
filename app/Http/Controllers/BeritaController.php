<?php

// app/Http/Controllers/BeritaController.php

namespace App\Http\Controllers;

use App\Models\artikel;
use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $search = (request()->input('search'));
        $beritas = artikel::with('kategori')
         ->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%");

            });
        })->paginate(10);
        return view('artikel.berita', compact('beritas'));

    }

    public function create()
    {
        $params = [
            "title" => "Tambah Berita",
            "action_form" => route("berita.store"),
            "method" => "POST",
            "kategori"=>Kategori::all(),
            "berita" => (object)[
                'judul' => '',
                'slug' => '',
                'isi' => '',
                'tanggal' => '',
                'gambar' => '',
                'kategori_id' => '',
            ]
        ];
        return view('artikel.tambah', $params);
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'judul' => 'required|string|max:255',
    //         'slug' => 'required|unique:beritas,slug',
    //         'isi' => 'required',
    //         'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'kategori_id' => 'required|exists:kategori,id',
    //     ]);

    //     $gambar = null;
    //     if ($request->hasFile('gambar')) {
    //         $gambar = $request->file('gambar')->store('images', 'public');
    //     }

    //     artikel::create([
    //         'judul' => $request->judul,
    //         'slug' => Str::slug($request->judul),
    //         'isi' => $request->isi,
    //         'gambar' => $gambar,
    //         // 'tanggal' => $tanggal,
    //         'kategori_id' => $request->kategori_id,
    //     ]);
    //     return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');
    // }
        public function store(Request $request)
        {

            $validated = $request->validate([
                'judul' => 'required|string|max:255',
                'slug' => 'required|unique:beritas,slug',
                'isi' => 'required',
                'tanggal' => 'required|date',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'kategori_id' => 'required|exists:kategori,id',
            ]);
            // dd(request()->all());
            $berita = new artikel(); // Pastikan model sesuai dengan tabel database
            $berita->judul = $validated['judul'];
            $berita->slug = $validated['slug'];
            $berita->isi = $validated['isi'];

            $berita->kategori_id = $validated['kategori_id'];

            // Cek apakah ada file gambar yang diunggah
            if ($request->hasFile('gambar')) {
                $berita->gambar = $request->file('gambar')->store('images', 'public');// Simpan nama file ke database
            }

            $berita->save();

            return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');

        }



    public function edit($id)
    {   $params = [
        "title" => "Edit Berita",
        "action_form" => route("berita.update",$id),
        "method" => "put",
        "kategori"=>Kategori::all(),
        "berita" =>
      artikel::find($id)
    ];
    return view('artikel.tambah', $params);
    }
    public function update(Request $request,$id)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'slug' => "required|unique:beritas,slug,$id,id",
            'isi' => 'required',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori_id' => 'required|exists:kategori,id',
        ]);
        // dd(request()->all());
        $berita =  artikel::find($id); // Pastikan model sesuai dengan tabel database
        $berita->judul = $validated['judul'];
        $berita->slug = $validated['slug'];
        $berita->isi = $validated['isi'];
        $berita->kategori_id = $validated['kategori_id'];

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
        $berita = artikel::findOrFail($id);
        $berita->delete();
        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}
