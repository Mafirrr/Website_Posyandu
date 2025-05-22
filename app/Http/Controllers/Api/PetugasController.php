<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');
        $aktif = $request->input('aktif');
        $role = $request->input('role'); // Tambahan filter role

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
            ->when($role, function ($query, $role) {  // Filter role jika ada parameter
                $query->where('role', $role);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return response()->json($petugas, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip' => 'required|string|max:20|unique:petugas,nip',
            'password' => 'required|string|min:6',
            'nama' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:20',
            'email' => 'required|email|unique:petugas,email',
            'role' => 'required|string|in:bidan',  // Validasi role
        ]);

        $petugas = Petugas::create([
            'nip' => $validated['nip'],
            'password' => Hash::make($validated['password']),
            'nama' => $validated['nama'],
            'no_telepon' => $validated['no_telepon'],
            'email' => $validated['email'],
            'role' => $validated['role'],  // Set sesuai input
        ]);

        return response()->json(['message' => 'Data petugas berhasil ditambahkan.', 'data' => $petugas], 201);
    }

    public function show($id)
    {
        $petugas = Petugas::findOrFail($id);

        return response()->json($petugas, 200);
    }

    public function update(Request $request, $id)
    {
        $petugas = Petugas::findOrFail($id);

        $validated = $request->validate([
            'nip' => 'required|string|max:20|unique:petugas,nip,' . $id,
            'password' => 'nullable|string|min:6',
            'nama' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:20',
            'email' => 'required|email|unique:petugas,email,' . $id,
            'role' => 'required|string|in:bidan',  // Tambah validasi role di update
        ]);

        $petugas->nip = $validated['nip'];
        if (!empty($validated['password'])) {
            $petugas->password = Hash::make($validated['password']);
        }
        $petugas->nama = $validated['nama'];
        $petugas->no_telepon = $validated['no_telepon'];
        $petugas->email = $validated['email'];
        $petugas->role = $validated['role'];
        $petugas->save();

        return response()->json(['message' => 'Data petugas berhasil diperbarui.', 'data' => $petugas], 200);
    }

    public function destroy($id)
    {
        $petugas = Petugas::findOrFail($id);
        $petugas->delete();

        return response()->json(['message' => 'Data petugas berhasil dihapus.'], 200);
    }
}
