<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Kehamilan;
use App\Models\Posyandu;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AnggotaController extends Controller
{

    use SoftDeletes;

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');
        $aktif = $request->input('aktif');

        $anggotas = Anggota::query()
            ->where(function ($query) {
                $query->where('role', 'ibu_hamil')
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
        return view('anggota.anggota', compact('anggotas'));
    }



    public function create()
    {
        $posyandus = Posyandu::all();

        $params = [
            "title" => "Tambah Anggota",
            "action_form" => route("anggota.store"),
            "method" => "POST",
            "anggota" => (object)[
                "nik" => "",
                'password' => "",
                'nama' => "",
                'role' => "ibu_hamil",
                'no_jkn' => "",
                'faskes_tk1' => "",
                'faskes_rujukan' => "",
                'tanggal_lahir' => "",
                'tempat_lahir' => "",
                'pekerjaan' => "",
                'alamat' => "",
                'no_telepon' => "",
                'posyandu_id' => "",
                'golongan_darah' => "",
                'aktif' => true,
            ]
        ];
        return view('anggota.form', $params, compact('posyandus'));
    }

    public function store(Request $request)
    {
        $formattedPhone = $this->formatNoTelepon($request->input('no_telepon'));

        // Ganti di request agar validasi & old() pakai nilai benar
        $request->merge([
            'no_telepon' => $formattedPhone,
        ]);
        $validated = $request->validate([
            'nik' => 'required|string|max:20|unique:anggota,nik',
            'nama' => 'required|string|max:255',
            'role' => 'required|string',
            'no_jkn' => 'nullable|string|max:13|unique:anggota,no_jkn',
            'faskes_tk1' => 'nullable|string|max:100',
            'faskes_rujukan' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'tempat_lahir' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:20|unique:anggota,no_telepon',
            'golongan_darah' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
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
            $anggota->no_jkn = $validated['no_jkn'];
            $anggota->faskes_tk1 = $validated['faskes_tk1'];
            $anggota->faskes_rujukan = $validated['faskes_rujukan'];
            $anggota->tanggal_lahir = $validated['tanggal_lahir'];
            $anggota->tempat_lahir = $validated['tempat_lahir'];
            $anggota->pekerjaan = $validated['pekerjaan'];
            $anggota->alamat = $validated['alamat'];
            $anggota->posyandu_id = $posyandu_id;
            $noTelepon = $validated['no_telepon'];

            // if (substr($noTelepon, 0, 2) === '08') {
            //     $noTelepon = '+628' . substr($noTelepon, 2);
            // }

            $anggota->no_telepon = $noTelepon;
            $anggota->golongan_darah = $validated['golongan_darah'];
            $anggota->aktif = true;
            $anggota->save();

            DB::commit();

            return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil ditambahkan.');
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
            "action_form" => route("anggota.update", $id),
            "method" => "PUT",
            "anggota" => $anggota,
            "riwayat" => $kehamilan,
            "posyandus" => $posyandus,
        ];

        return view('anggota.form', $params);
    }

    public function update(Request $request, $id)
    {
        $formattedPhone = $this->formatNoTelepon($request->input('no_telepon'));

        // Ganti di request agar validasi & old() pakai nilai benar
        $request->merge([
            'no_telepon' => $formattedPhone,
        ]);
        $validated = $request->validate([
            'nik' => 'required|string|max:20|unique:anggota,nik,' . $id,
            'password' => 'nullable|string|min:6',
            'nama' => 'required|string|max:255',
            'role' => 'required|string',
            'no_jkn' => 'nullable|string|max:13|unique:anggota,no_jkn,' . $id,
            'faskes_tk1' => 'nullable|string|max:100',
            'faskes_rujukan' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'tempat_lahir' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:16|unique:anggota,no_telepon,' . $id,
            'golongan_darah' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
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
            $anggota->no_jkn = $validated['no_jkn'];
            $anggota->faskes_tk1 = $validated['faskes_tk1'];
            $anggota->faskes_rujukan = $validated['faskes_rujukan'];
            $anggota->tanggal_lahir = $validated['tanggal_lahir'];
            $anggota->tempat_lahir = $validated['tempat_lahir'];
            $anggota->pekerjaan = $validated['pekerjaan'];
            $anggota->alamat = $validated['alamat'];
            $noTelepon = '+62' . ltrim($validated['no_telepon'], '0');

            if (substr($noTelepon, 0, 2) === '08') {
                $noTelepon = '+628' . substr($noTelepon, 2);
            }

            $anggota->no_telepon = $noTelepon;
            $anggota->posyandu_id = $posyandu_id;
            $anggota->golongan_darah = $validated['golongan_darah'];
            $anggota->aktif = $validated['status'];
            $anggota->save();

            DB::commit();

            return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil diperbarui.');
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

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil dihapus.');
    }

    public function suggest(Request $request)
    {
        $query = $request->get('q');
        $currentAnggotaId = Auth::guard('kader')->check() ? Auth::guard('kader')->user()->id : null;


        $anggota = Anggota::where('nama', 'like', "%$query%")
            ->where('id', '!=', $currentAnggotaId)
            ->limit(10)
            ->get(['id', 'nama']);

        return response()->json($anggota);
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
