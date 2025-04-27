<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
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
                        ->orWhere('alamat', 'like', "%{$search}%");
                });
            })
            ->when($aktif !== null && $aktif !== '', function ($query) use ($aktif) {
                $query->where('aktif', $aktif);
            })
            ->orderBy('created_at', 'asc')
            ->paginate($perPage)
            ->appends(request()->query());

        return view('anggota.anggota', compact('anggotas'));
    }



    public function anggota_add()
    {
        $params = [
            "title"=>"Tambah Anggota",
            "action_form"=>route("anggota.store"),
            "method"=>"POST",
            "anggota"=>(object)[
                "nik"=>"",
                'password'=>"",
                'nama'=>"",
                'tanggal_lahir'=>"",
                'tempat_lahir'=>"",
                'pekerjaan'=>"",
                'alamat'=>"",
                'no_telepon'=>"",
                'golongan_darah'=>"",
                'aktif'=>"",
            ]
        ];
        return view('anggota.form', $params);
    }

    public function anggota_store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|string|max:20|unique:anggota,nik',
            'password' => 'required|string|min:6',
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:20',
            'golongan_darah' => 'required|string|max:3',
        ]);

        $anggota = new Anggota();
        $anggota->nik = $validated['nik'];
        $anggota->password = bcrypt($validated['password']);
        $anggota->nama = $validated['nama'];
        $anggota->tanggal_lahir = $validated['tanggal_lahir'];
        $anggota->tempat_lahir = $validated['tempat_lahir'];
        $anggota->pekerjaan = $validated['pekerjaan'];
        $anggota->alamat = $validated['alamat'];
        $anggota->no_telepon = $validated['no_telepon'];
        $anggota->golongan_darah = $validated['golongan_darah'];
        $anggota->save();

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil ditambahkan.');
    }

    public function anggota_edit($id)
    {
        $anggota = Anggota::findOrFail($id);
        $params = [
            "title"=>"Ubah Anggota",
            "action_form"=>route("anggota.update",$id),
            "method"=>"PUT",
            "anggota"=> $anggota
        ];
        return view('anggota.form', $params);
    }

    public function anggota_update(Request $request, $id)
    {
        $validated = $request->validate([
            'nik' => 'required|string|max:20|unique:anggota,nik,' . $id,
            'password' => 'nullable|string|min:6',
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:20',
            'golongan_darah' => 'required|string|max:3',
            'status' => 'required|boolean',
        ]);

        $anggota = Anggota::findOrFail($id);
        $anggota->nik = $validated['nik'];
        if (!empty($validated['password'])) {
            $anggota->password = bcrypt($validated['password']);
        }
        $anggota->nama = $validated['nama'];
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

    public function anggota_destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil dihapus.');
    }

}
