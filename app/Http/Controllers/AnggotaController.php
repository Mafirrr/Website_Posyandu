<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{

    use SoftDeletes;

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');
        $aktif = $request->input('aktif');

        $anggotas = Anggota::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nik', 'like', "%{$search}%")
                        ->orWhere('nama', 'like', "%{$search}%")
                        ->orWhere('alamat', 'like', "%{$search}%")
                        ->orWhere('no_jkn', 'like', "%{$search}%");
                });
            })
            ->when($aktif !== null && $aktif !== '', function ($query) use ($aktif) {
                $query->where('aktif', $aktif);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->appends(request()->query());
        return view('anggota.anggota', compact('anggotas'));
    }



    public function create()
    {
        $params = [
            "title" => "Tambah Anggota",
            "action_form" => route("anggota.store"),
            "method" => "POST",
            "anggota" => (object)[
                "nik" => "",
                'password' => "",
                'nama' => "",
                'no_jkn' => "",
                'faskes_tk1' => "",
                'faskes_rujukan' => "",
                'tanggal_lahir' => "",
                'tempat_lahir' => "",
                'pekerjaan' => "",
                'alamat' => "",
                'no_telepon' => "",
                'golongan_darah' => "",
                'aktif' => true,
            ]
        ];
        return view('anggota.form', $params);
    }

    public function store(Request $request)
    {
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
        $anggota->no_telepon = $validated['no_telepon'];
        $anggota->golongan_darah = $validated['golongan_darah'];
        $anggota->aktif = true;
        $anggota->save();

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);
        $params = [
            "title" => "Ubah Anggota",
            "action_form" => route("anggota.update", $id),
            "method" => "PUT",
            "anggota" => $anggota
        ];
        return view('anggota.form', $params);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nik' => 'required|string|max:20|unique:anggota,nik,' . $id,
            'password' => 'nullable|string|min:6',
            'nama' => 'required|string|max:255',
            'no_jkn' => 'required|string|max:13|unique:anggota,no_jkn,' . $id,
            'faskes_tk1' => 'required|string|max:100',
            'faskes_rujukan' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:16|unique:anggota,no_telepon,' . $id,
            'golongan_darah' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'status' => 'required|boolean',
        ]);

        $anggota = Anggota::findOrFail($id);
        $anggota->nik = $validated['nik'];
        if (!empty($validated['password'])) {
            $anggota->password = bcrypt($validated['password']);
        }
        $anggota->nama = $validated['nama'];
        $anggota->no_jkn = $validated['no_jkn'];
        $anggota->faskes_tk1 = $validated['faskes_tk1'];
        $anggota->faskes_rujukan = $validated['faskes_rujukan'];
        $anggota->tanggal_lahir = $validated['tanggal_lahir'];
        $anggota->tempat_lahir = $validated['tempat_lahir'];
        $anggota->pekerjaan = $validated['pekerjaan'];
        $anggota->alamat = $validated['alamat'];
        $anggota->no_telepon = $validated['no_telepon'];
        $anggota->golongan_darah = $validated['golongan_darah'];
        $anggota->aktif = $validated['status'];
        $anggota->save();

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil dihapus.');
    }

    public function suggest(Request $request)
    {
        $query = $request->get('q');

        $anggota = Anggota::where('nama', 'like', "%$query%")
            ->limit(10)
            ->get(['id', 'nama']);

        return response()->json($anggota);
    }
}
