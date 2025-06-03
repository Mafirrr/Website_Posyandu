<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Kehamilan;
use App\Models\Posyandu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KaderController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');
        $aktif = $request->input('aktif');

        $anggotas = Anggota::query()
            ->where(function ($query) {
                $query->where('role', 'kader')
                    ->orWhere('role', 'ibu_hamil_kader');
            })
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
            ->orderBy('created_at', 'desc')->with('posyandu')
            ->paginate($perPage)
            ->appends(request()->query());
        return view('kader.kader', compact('anggotas'));
    }
    public function create()
    {
        $posyandus = Posyandu::all();

        $params = [
            "title" => "Tambah Anggota",
            "action_form" => route("kader.store"),
            "method" => "POST",
            "anggota" => (object)[
                "nik" => "",
                'password' => "",
                'nama' => "",
                'role' => "kader",
                'tanggal_lahir' => "",
                'tempat_lahir' => "",
                'pekerjaan' => "",
                'alamat' => "",
                'no_telepon' => "",
                'posyandu_id' => "",
                'aktif' => true,
            ]
        ];
        return view('kader.kaderform', $params, compact('posyandus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|string|max:20|unique:anggota,nik',
            'nama' => 'required|string|max:255',
            'role' => 'required|string',
            'tanggal_lahir' => 'nullable|date',
            'tempat_lahir' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:20',
        ]);


        try {
            DB::beginTransaction();

            if ($request->posyandu_id === 'lainnya') {
                $request->validate([
                    'posyandu_baru' => 'required|string|max:100',
                ]);

                $posyanduBaru = Posyandu::create([
                    'nama' => $request->posyandu_baru,
                ]);

                $posyandu_id = $posyanduBaru->id;
            } else {
                $request->validate([
                    'posyandu_id' => 'required|exists:posyandu,id',
                ]);

                $posyandu_id = $request->posyandu_id;
            }

            $anggota = new Anggota();
            $anggota->nik = $validated['nik'];
            $anggota->password = bcrypt('password123');
            $anggota->nama = $validated['nama'];
            $anggota->role = $validated['role'];
            $anggota->tanggal_lahir = $validated['tanggal_lahir'];
            $anggota->tempat_lahir = $validated['tempat_lahir'];
            $anggota->pekerjaan = $validated['pekerjaan'];
            $anggota->alamat = $validated['alamat'];
            $anggota->posyandu_id = $posyandu_id;

            $noTelepon = $validated['no_telepon'];
            if (substr($noTelepon, 0, 2) === '08') {
                $noTelepon = '+628' . substr($noTelepon, 2);
            }
            $anggota->no_telepon = $noTelepon;

            $anggota->aktif = true;
            $anggota->save();

            DB::commit();

            return redirect()->route('kader.index')->with('success', 'Data kader berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error menambahkan data kader: ' . $e->getMessage());

            return back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);
        $kehamilan = Kehamilan::where('anggota_id', $id)->get();
        $posyandus = Posyandu::all();
        $params = [
            "title" => "Ubah Anggota",
            "action_form" => route("kader.update", $id),
            "method" => "PUT",
            "anggota" => $anggota,
            "riwayat" => $kehamilan,
            "posyandus" => $posyandus,
        ];

        return view('kader.kaderform', $params);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nik' => 'required|string|max:20|unique:anggota,nik,' . $id,
            'password' => 'nullable|string|min:6',
            'nama' => 'required|string|max:255',
            'role' => 'required|string',
            'tanggal_lahir' => 'nullable|date',
            'tempat_lahir' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:16|unique:anggota,no_telepon,' . $id,
            'status' => 'required|boolean',
        ]);


        try {
            DB::beginTransaction();

            if ($request->posyandu_id === 'lainnya') {
                $request->validate([
                    'posyandu_baru' => 'required|string|max:100',
                ]);

                $posyanduBaru = Posyandu::create([
                    'nama' => $request->posyandu_baru,
                ]);

                $posyandu_id = $posyanduBaru->id;
            } else {
                $request->validate([
                    'posyandu_id' => 'required|exists:posyandu,id',
                ]);

                $posyandu_id = $request->posyandu_id;
            }


            $anggota = Anggota::findOrFail($id);
            $anggota->nik = $validated['nik'];
            if (!empty($validated['password'])) {
                $anggota->password = bcrypt($validated['password']);
            }
            $anggota->nama = $validated['nama'];
            $anggota->role = $validated['role'];
            $anggota->tanggal_lahir = $validated['tanggal_lahir'];
            $anggota->tempat_lahir = $validated['tempat_lahir'];
            $anggota->pekerjaan = $validated['pekerjaan'];
            $anggota->alamat = $validated['alamat'];
            $noTelepon = $validated['no_telepon'];

            if (substr($noTelepon, 0, 2) === '08') {
                $noTelepon = '+628' . substr($noTelepon, 2);
            }

            $anggota->no_telepon = $noTelepon;
            $anggota->posyandu_id = $posyandu_id;
            $anggota->aktif = $validated['status'];
            $anggota->save();

            DB::commit();

            return redirect()->route('kader.index')->with('success', 'Data kader berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error menambahkan data kader: ' . $e->getMessage());

            return back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();

        return redirect()->route('kader.index')->with('success', 'Data kader berhasil dihapus.');
    }
}
