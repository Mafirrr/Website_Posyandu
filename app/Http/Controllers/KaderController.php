<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;

class KaderController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');
        $aktif = $request->input('aktif');

        $kader = Petugas::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nip', 'like', "%{$search}%")
                        ->orWhere('nama', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($aktif !== null && $aktif !== '', function ($query) use ($aktif) {
                $query->where('aktif', $aktif);
            })
            ->where('role', 'kader')
            ->orderBy('created_at', 'asc')
            ->paginate($perPage)
            ->appends(request()->query());

        return view('kader.kader', compact('kader'));
    }
    public function kader_add()
    {
        $params = [
            "title" => "Tambah kader",
            "action_form" => route("kader.store"),
            "method" => "POST",
            "kader" => (object)[
                "nip" => "",
                'password' => "",
                'nama' => "",
                'no_telepon' => "",
                'email' => "",
            ]
        ];
        return view('kader.kaderform', $params);
    }

    public function kader_store(Request $request)
    {
        $validated = $request->validate([
            'nip' => 'required|string|max:20|unique:kader,nip',
            'password' => 'required|string|min:6',
            'nama' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:20',
            'email' => 'required|email|unique:kader,email',
        ]);

        $kader = new Petugas();
        $kader->nip = $validated['nip'];
        $kader->password = bcrypt($validated['password']);
        $kader->nama = $validated['nama'];
        $kader->no_telepon = $validated['no_telepon'];
        $kader->email = $validated['email'];
        $kader->role = 'bidan';
        $kader->save();
        return redirect()->route('kader.index')->with('success', 'Data kader berhasil ditambahkan.');
    }

    public function kader_edit($id)
    {
        $kader = Petugas::findOrFail($id);
        $params = [
            "title" => "Edit kader",
            "action_form" => route("kader.update", $id),
            "method" => "PUT",
            "kader" => $kader
        ];
        return view('kader.kaderform', $params);
    }

    public function kader_update(Request $request, $id)
    {
        $validated = $request->validate([
            'nip' => 'required|string|max:20|unique:kader,nip,' . $id,
            'password' => 'nullable|string|min:6',
            'nama' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:20',
            'email' => 'required|email|unique:kader,email,' . $id,
        ]);

        $kader = Petugas::findOrFail($id);
        $kader->nip = $validated['nip'];
        if (!empty($validated['password'])) {
            $kader->password = bcrypt($validated['password']);
        }
        $kader->nama = $validated['nama'];
        $kader->no_telepon = $validated['no_telepon'];
        $kader->email = $validated['email'];
        $kader->save();


        return redirect()->route('kader.index')->with('success', 'Data kader berhasil diperbarui.');
    }

    public function kader_destroy($id)
    {
        $kader = Petugas::findOrFail($id);
        $kader->delete();

        return redirect()->route('kader.index')->with('success', 'Data kader berhasil dihapus.');
    }
}
