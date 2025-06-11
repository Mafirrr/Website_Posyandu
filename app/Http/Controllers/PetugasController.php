<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PetugasController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');
        $aktif = $request->input('aktif');

        $petugas = Petugas::query()
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
            ->where('role', 'bidan')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->appends(request()->query());

        return view('petugas.petugas', compact('petugas'));
    }

    public function create()
    {
        $params = [
            "title" => "Tambah Petugas",
            "action_form" => route("petugas.store"),
            "method" => "POST",
            "petugas" => (object)[
                "nip" => "",
                'password' => "bidan123",
                'nama' => "",
                'no_telepon' => "",
                'email' => "",
            ]
        ];
        return view('petugas.petugasform', $params);
    }

    public function store(Request $request)
    {
        // Normalisasi nomor telepon dulu
     $formattedPhone = $this->formatNoTelepon($request->input('no_telepon'));

    // Ganti di request agar validasi & old() pakai nilai benar
    $request->merge([
        'no_telepon' => $formattedPhone,
    ]);
        // dd($noTeleponFormatted);
        $validated = $request->validate([
            'nip' => 'required|string|max:20|unique:petugas,nip',
            'nama' => 'required|string|max:255',
            'no_telepon' => [
            'required',
            'string',
            'regex:/^\+628[0-9]{6,12}$/',   // pastikan format +62...
            'unique:petugas,no_telepon',    // sekarang cocok ↔ DB
        ],
            'email' => 'required|email|unique:petugas,email',
        ]);

        $petugas = new Petugas();
        $petugas->nip = $validated['nip'];
        $petugas->password = bcrypt('bidan123');
        $petugas->nama = $validated['nama'];
        $petugas->no_telepon = $validated['no_telepon'];
        $petugas->email = $validated['email'];
        $petugas->role = 'bidan';
        $petugas->save();

        return redirect()->route('petugas.index')->with('success', 'Data petugas berhasil ditambahkan.');
    }
    public function edit($id)
    {
        $petugas = Petugas::findOrFail($id);
        $params = [
            "title" => "Edit Petugas",
            "action_form" => route("petugas.update", $id),
            "method" => "PUT",
            "petugas" => $petugas,
            "can_edit_password" => Auth::user()->role === 'bidan'
        ];
        return view('petugas.petugasform', $params);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nip' => 'required|string|max:20|unique:petugas,nip,' . $id,
            'nama' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:20',
            'email' => 'required|email|unique:petugas,email,' . $id,
        ]);

        $petugas = Petugas::findOrFail($id);
        $petugas->nip = $validated['nip'];
        $petugas->nama = $validated['nama'];
        $petugas->no_telepon = '+62' . ltrim($validated['no_telepon'], '0');
        $petugas->email = $validated['email'];

        if (Auth::user()->role === 'bidan' && $request->filled('password')) {
            $request->validate(['password' => 'nullable|string|min:6']);
            $petugas->password = bcrypt($request->input('password'));
        }

        $petugas->save();

        return redirect()->route('petugas.index')->with('success', 'Data petugas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $petugas = Petugas::findOrFail($id);
        $petugas->delete();

        return redirect()->route('petugas.index')->with('success', 'Data petugas berhasil dihapus.');
    }
    private function formatNoTelepon($no)
{
    $no = preg_replace('/[^0-9+]/', '', $no); // hilangkan karakter non-digit

    if (str_starts_with($no, '+62')) {
        return $no;
    } elseif (str_starts_with($no, '62')) {
        return '+' . $no;
    } elseif (str_starts_with($no, '0')) {
        return '+62' . substr($no, 1);
    } else {
        return '+62' . $no;
    }
}
}
