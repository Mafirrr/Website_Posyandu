<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Kehamilan;
use App\Models\LabTrimester1;
use App\Models\LabTrimester3;
use App\Models\Nifas;
use App\Models\PemeriksaanAwal;
use App\Models\PemeriksaanFisik;
use App\Models\PemeriksaanKehamilan;
use App\Models\PemeriksaanKhusus;
use App\Models\PemeriksaanRutin;
use App\Models\RencanaKonsultasi;
use App\Models\SkriningKesehatanJiwa;
use App\Models\Trimester1;
use App\Models\Trimester3;
use App\Models\UsgTrimester1;
use App\Models\UsgTrimester3;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Trimester extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pemeriksaan_kehamilan.jenis_pemeriksaan' => 'required',
            'pemeriksaan_kehamilan.kehamilan_id' => 'required',
        ]);

        switch ($validated['pemeriksaan_kehamilan']['jenis_pemeriksaan']) {
            case "trimester1":
                return $this->trimester1($request);
            case "trimester2":
                return $this->trimester2($request);
            case "trimester3":
                return $this->trimester3($request);
            case "nifas":
                return $this->nifas($request);
            default:
                abort(400, 'Trimester tidak valid');
        }
    }

    public function trimester1(Request $request)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'pemeriksaan_kehamilan.jenis_pemeriksaan' => 'required',
                'pemeriksaan_kehamilan.kehamilan_id' => 'required',
                'pemeriksaan_kehamilan.petugas_id' => 'required',
                'pemeriksaan_kehamilan.tanggal_pemeriksaan' => 'required|date',
                'pemeriksaan_kehamilan.tempat_pemeriksaan' => 'required',
            ]);


            $kehamilan = new Kehamilan();
            $kehamilan->anggota_id = $validated['pemeriksaan_kehamilan']['kehamilan_id'];
            $kehamilan->save();

            // Simpan PemeriksaanKehamilan
            $pemeriksaan = PemeriksaanKehamilan::create([
                'jenis_pemeriksaan' => $validated['pemeriksaan_kehamilan']['jenis_pemeriksaan'],
                'kehamilan_id' => $kehamilan->id,
                'kader_id' => $validated['pemeriksaan_kehamilan']['petugas_id'],
                'tanggal_pemeriksaan' => $validated['pemeriksaan_kehamilan']['tanggal_pemeriksaan'],
                'tempat_pemeriksaan' => $validated['pemeriksaan_kehamilan']['tempat_pemeriksaan'],
            ]);

            $data = $request->input('trimester1');
            $data['pemeriksaan_id'] = $pemeriksaan->id;

            // Simpan masing-masing data relas
            $pemeriksaanRutin = PemeriksaanRutin::create(array_merge($data['pemeriksaan_rutin'], [
                'pemeriksaan_id' => $pemeriksaan->id
            ]));

            $anggota = Anggota::find($validated['pemeriksaan_kehamilan']['kehamilan_id']);
            $anggota->update([
                'golongan_darah' => $pemeriksaanRutin->golongan_darah,
            ]);

            $skriningKesehatan = SkriningKesehatanJiwa::create($data['skrining_kesehatan']);
            $pemeriksaanFisik = PemeriksaanFisik::create($data['pemeriksaan_fisik']);
            $pemeriksaanAwal = PemeriksaanAwal::create($data['pemeriksaan_awal']);
            $pemeriksaanKhusus = PemeriksaanKhusus::create($data['pemeriksaan_khusus']);
            $labTrimester1 = LabTrimester1::create($data['lab_trimester1']);
            $usgTrimester1 = UsgTrimester1::create($data['usg_trimester1']);

            // Simpan data Trimester1
            $trimester1 = Trimester1::create([
                'pemeriksaan_id' => $pemeriksaan->id,
                'skrining_kesehatan' => $skriningKesehatan->id,
                'pemeriksaan_fisik' => $pemeriksaanFisik->id,
                'pemeriksaan_awal' => $pemeriksaanAwal->id,
                'pemeriksaan_khusus' => $pemeriksaanKhusus->id,
                'lab_trimester_1' => $labTrimester1->id,
                'usg_trimester_1' => $usgTrimester1->id,
            ]);

            DB::commit();
            return response()->json(['message' => 'Data pemeriksaan berhasil disimpan.'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Gagal menyimpan data', 'error' => $e->getMessage()], 500);
        }
    }
    public function trimester2(Request $request)
    {
        $validated = $request->validate([
            'pemeriksaan_kehamilan.jenis_pemeriksaan' => 'required',
            'pemeriksaan_kehamilan.kehamilan_id' => 'required',
            'pemeriksaan_kehamilan.petugas_id' => 'required',
            'pemeriksaan_kehamilan.tanggal_pemeriksaan' => 'required|date',
            'pemeriksaan_kehamilan.tempat_pemeriksaan' => 'required',
        ]);

        try {
            $kehamilan = Kehamilan::where('anggota_id', $validated['pemeriksaan_kehamilan']['kehamilan_id'])->latest()->first();
            DB::beginTransaction();

            $pemeriksaan = PemeriksaanKehamilan::create([
                'jenis_pemeriksaan' => $validated['pemeriksaan_kehamilan']['jenis_pemeriksaan'],
                'kehamilan_id' => $kehamilan->id,
                'kader_id' => $validated['pemeriksaan_kehamilan']['petugas_id'],
                'tanggal_pemeriksaan' => $validated['pemeriksaan_kehamilan']['tanggal_pemeriksaan'],
                'tempat_pemeriksaan' => $validated['pemeriksaan_kehamilan']['tempat_pemeriksaan'],
            ]);

            $dataRutin = $request['trimester2'];

            if (!$dataRutin) {
                return response()->json([
                    'message' => 'Data pemeriksaan_rutin kosong',
                    'body' => $request->all()
                ], 422);
            }

            $dataRutin['pemeriksaan_id'] = $pemeriksaan->id;
            PemeriksaanRutin::create($dataRutin);


            DB::commit();
            return response()->json(['message' => 'Data pemeriksaan berhasil disimpan.'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Gagal menyimpan data', 'error' => $e->getMessage()], 500);
        }
    }
    public function nifas(Request $request)
    {
        $validated = $request->validate([
            'pemeriksaan_kehamilan.jenis_pemeriksaan' => 'required',
            'pemeriksaan_kehamilan.kehamilan_id' => 'required',
            'pemeriksaan_kehamilan.petugas_id' => 'required',
            'pemeriksaan_kehamilan.tanggal_pemeriksaan' => 'required',
            'pemeriksaan_kehamilan.tempat_pemeriksaan' => 'required',
        ]);

        try {
            $kehamilan = Kehamilan::where('anggota_id', $validated['pemeriksaan_kehamilan']['kehamilan_id'])->latest()->first();

            if (!$kehamilan) {
                return response()->json(['message' => 'Data kehamilan tidak ditemukan.'], 404);
            }

            DB::beginTransaction();

            $pemeriksaan = PemeriksaanKehamilan::create([
                'jenis_pemeriksaan' => $validated['pemeriksaan_kehamilan']['jenis_pemeriksaan'],
                'kehamilan_id' => $kehamilan->id,
                'kader_id' => $validated['pemeriksaan_kehamilan']['petugas_id'],
                'tanggal_pemeriksaan' => $validated['pemeriksaan_kehamilan']['tanggal_pemeriksaan'],
                'tempat_pemeriksaan' => $validated['pemeriksaan_kehamilan']['tempat_pemeriksaan'],
            ]);

            $dataNifas = $request->input('nifas');

            if (!$dataNifas) {
                return response()->json([
                    'message' => 'Data pemeriksaan nifas kosong.',
                    'body' => $request->all()
                ], 422);
            }

            $dataNifas['pemeriksaan_id'] = $pemeriksaan->id;
            Nifas::create($dataNifas);

            DB::commit();

            return response()->json(['message' => 'Data pemeriksaan nifas berhasil disimpan.'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Gagal menyimpan data pemeriksaan nifas',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function trimester3(Request $request)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'pemeriksaan_kehamilan.jenis_pemeriksaan' => 'required',
                'pemeriksaan_kehamilan.kehamilan_id' => 'required',
                'pemeriksaan_kehamilan.petugas_id' => 'required',
                'pemeriksaan_kehamilan.tanggal_pemeriksaan' => 'required|date',
                'pemeriksaan_kehamilan.tempat_pemeriksaan' => 'required',
            ]);


            $kehamilan = Kehamilan::where('anggota_id', $validated['pemeriksaan_kehamilan']['kehamilan_id'])->latest()->first();
            DB::beginTransaction();

            $pemeriksaan = PemeriksaanKehamilan::create([
                'jenis_pemeriksaan' => $validated['pemeriksaan_kehamilan']['jenis_pemeriksaan'],
                'kehamilan_id' => $kehamilan->id,
                'kader_id' => $validated['pemeriksaan_kehamilan']['petugas_id'],
                'tanggal_pemeriksaan' => $validated['pemeriksaan_kehamilan']['tanggal_pemeriksaan'],
                'tempat_pemeriksaan' => $validated['pemeriksaan_kehamilan']['tempat_pemeriksaan'],
            ]);

            $data = $request->input('trimester3');
            $data['pemeriksaan_id'] = $pemeriksaan->id;

            // Simpan masing-masing data relas
            $pemeriksaanRutin = PemeriksaanRutin::create(array_merge($data['pemeriksaan_rutin'], [
                'pemeriksaan_id' => $pemeriksaan->id
            ]));

            $skriningKesehatan = SkriningKesehatanJiwa::create($data['skrining_kesehatan']);
            $pemeriksaanFisik = PemeriksaanFisik::create($data['pemeriksaan_fisik']);
            $labTrimester1 = LabTrimester3::create($data['lab_trimester3']);
            $usgTrimester1 = UsgTrimester3::create($data['usg_trimester3']);
            $rencana = RencanaKonsultasi::create($data['rencana_konsultasi']);

            // Simpan data Trimester1
            $trimester1 = Trimester3::create([
                'pemeriksaan_id' => $pemeriksaan->id,
                'skrining_kesehatan' => $skriningKesehatan->id,
                'pemeriksaan_fisik' => $pemeriksaanFisik->id,
                'lab_trimester_3' => $labTrimester1->id,
                'usg_trimester_3' => $usgTrimester1->id,
                'rencana_konsultasi' => $rencana->id,
            ]);

            DB::commit();
            return response()->json(['message' => 'Data pemeriksaan berhasil disimpan.'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Gagal menyimpan data', 'error' => $e->getMessage()], 500);
        }
    }
}
