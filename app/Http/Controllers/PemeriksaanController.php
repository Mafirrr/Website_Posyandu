<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Kehamilan;
use App\Models\LabTrimester1;
use App\Models\PemeriksaanAwal;
use App\Models\PemeriksaanFisik;
use App\Models\PemeriksaanKehamilan;
use App\Models\PemeriksaanKhusus;
use App\Models\PemeriksaanRutin;
use App\Models\SkriningKesehatanJiwa;
use App\Models\Trimester1;
use App\Models\UsgTrimester1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemeriksaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pemeriksaan.pemeriksaan');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'anggota_id' => 'required',
            'trimester' => 'required'
        ]);

        switch ($validated['trimester']) {
            case 1:
                return $this->trimester1($request);
            case 2:
                return $this->trimester2($request);
            case 3:
                return $this->trimester3($request);
            default:
                abort(400, 'Trimester tidak valid');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function trimester1(Request $request)
    {
        $validated = $request->validate([
            'anggota_id' => 'required|exists:anggota,id',

            // Pemeriksaan dasar
            'tanggal_periksa1' => 'required|date',
            'tempat_periksa1' => 'required|string',
            'berat_badan1' => 'required|numeric|min:30|max:200',
            'tinggi_badan1' => 'required|numeric|min:100|max:250',
            'lingkar_lengan1' => 'required|numeric|min:10|max:50',
            'sistolik' => 'required|numeric|min:70|max:200',
            'diastolik' => 'required|numeric|min:40|max:150',
            'tinggi_rahim1' => 'nullable|string',
            'denyut_janin1' => 'nullable|string',
            'imunisasi_tetanus1' => 'nullable|string',
            'konseling1' => 'nullable|string',
            'skrining_dokter1' => 'nullable|string',
            'tambah_darah1' => 'nullable|string',
            'gol_darah1' => 'nullable|in:A+,B+,AB+,O+,A-,B-,AB-,O-',

            // Pemeriksaan riwayat
            'riwayat_kesehatan_ibu' => 'array|nullable',
            'riwayat_kesehatan' => 'array|nullable',
            'riwayat_kesehatan_keluarga' => 'array|nullable',

            // Pemeriksaan organ reproduksi
            'tt' => 'nullable|in:1,2,3,4,5',
            'porsio' => 'nullable|in:normal,tidak_normal',
            'uretra' => 'nullable|in:normal,tidak_normal',
            'vagina' => 'nullable|in:normal,tidak_normal',
            'vulva' => 'nullable|in:normal,tidak_normal',
            'fluksus' => 'nullable|in:positif,negatif',
            'fluor' => 'nullable|in:positif,negatif',

            // Pemeriksaan umum
            'konjungtiva1' => 'nullable|in:anemia,tidak_anemia',
            'sklera1' => 'nullable|in:ikterik,tidak_ikterik',
            'kulit1' => 'nullable|in:normal,tidak_normal',
            'gigi_mulut1' => 'nullable|in:normal,tidak_normal',
            'leher1' => 'nullable|in:normal,tidak_normal',
            'tht1' => 'nullable|in:normal,tidak_normal',
            'dada1' => 'nullable|in:normal,tidak_normal',
            'jantung1' => 'nullable|in:normal,tidak_normal',
            'paru1' => 'nullable|in:normal,tidak_normal',
            'perut1' => 'nullable|in:normal,tidak_normal',
            'tungkai1' => 'nullable|in:normal,tidak_normal',

            // Riwayat haid & kehamilan
            'hpht' => 'nullable|string',
            'haid' => 'nullable|in:teratur,tidak_teratur',
            'umur_kehamilan_hpht' => 'nullable|numeric',
            'hpl_hpht' => 'nullable|string',
            'umur_kehamilan_usg' => 'nullable|numeric',
            'hpl_usg' => 'nullable|string',

            // USG
            'jumlah_gs' => 'nullable|string',
            'diameter_gs' => 'nullable|numeric',
            'gs_minggu' => 'nullable|numeric',
            'gs_hari' => 'nullable|numeric',
            'jumlah_bayi' => 'nullable|string',
            'crl' => 'nullable|numeric',
            'crl_minggu' => 'nullable|numeric',
            'crl_hari' => 'nullable|numeric',
            'letak_produk' => 'nullable|string',
            'pulsasi_jantung' => 'nullable|in:tampak,tidak_tampak',
            'kecurigaan_temuan' => 'nullable|in:ya,tidak',
            'alasan' => 'nullable|string|max:255',

            // Pemeriksaan laboratorium
            'hemoglobin1' => 'nullable|numeric',
            'hemoglobin1_rtl' => 'nullable|string',
            'golDarah_rhesus' => 'nullable|string',
            'rhesus_rtl' => 'nullable|string',
            'gulaDarah1' => 'nullable|numeric',
            'gulaDarah1_rtl' => 'nullable|string',
            'h' => 'nullable|in:reaktif,non_reaktif',
            's' => 'nullable|in:reaktif,non_reaktif',
            'hepatitis' => 'nullable|in:reaktif,non_reaktif',

            // Skrining jiwa
            'skrining_jiwa_tr1' => 'nullable|in:ya,tidak',
            'tindak_lanjut_tr1' => 'nullable|string',
            'rujukan_tr1' => 'nullable|in:ya,tidak',
        ]);

        try {
            DB::beginTransaction();
            //kehamilan
            $kehamilan = new Kehamilan();
            $kehamilan->anggota_id = $validated['anggota_id'];
            $kehamilan->save();

            //pemeriksaan kehamilan
            $pemeriksaan = new PemeriksaanKehamilan();
            $pemeriksaan->kehamilan_id = $kehamilan->id;
            $pemeriksaan->petugas_id = auth()->user()->id;
            $pemeriksaan->tanggal_pemeriksaan = $validated['tanggal_periksa1'];
            $pemeriksaan->tempat_pemeriksaan = $validated['tempat_periksa1'];
            $pemeriksaan->jenis_pemeriksaan = 'trimester1';
            $pemeriksaan->save();

            //pemeriksaan rutin
            $rutin = new PemeriksaanRutin();
            $rutin->pemeriksaan_id = $pemeriksaan->id;
            $rutin->berat_badan = $validated['berat_badan1'];
            $rutin->tinggi_rahim = $validated['tinggi_rahim1'];
            $rutin->tekanan_darah_sistol = $validated['sistolik'];
            $rutin->tekanan_darah_diastol = $validated['diastolik'];
            $rutin->letak_dan_denyut_nadi_bayi = $validated['denyut_janin1'];
            $rutin->lingkar_lengan_atas = $validated['lingkar_lengan1'];
            $rutin->save();

            //pemeriksaan awal
            $awal = new PemeriksaanAwal();
            $awal->tinggi_badan = $validated['tinggi_badan1'];
            $awal->golongan_darah = $validated['gol_darah1'];
            $awal->status_imunisasi_td = 't' . $validated['tt'];
            $awal->hemoglobin = $validated['hemoglobin1'];
            $awal->riwayat_kesehatan_ibu_sekarang = $validated['riwayat_kesehatan_ibu'];
            $awal->riwayat_perilaku = $validated['riwayat_kesehatan'];
            $awal->riwayat_penyakit_keluarga = $validated['riwayat_kesehatan_keluarga'];
            $awal->save();

            //pemeriksaan fisik
            $fisik = new PemeriksaanFisik();
            $fisik->konjungtiva = $validated['konjungtiva1'];
            $fisik->sklera = $validated['sklera1'];
            $fisik->kulit = $validated['kulit1'];
            $fisik->leher = $validated['leher1'];
            $fisik->gigi_mulut = $validated['gigi_mulut1'];
            $fisik->tht = $validated['tht1'];
            $fisik->jantung = $validated['jantung1'];
            $fisik->paru = $validated['paru1'];
            $fisik->perut = $validated['perut1'];
            $fisik->tungkai = $validated['tungkai1'];
            $fisik->save();

            //pemeriksaan khusus
            $khusus = new PemeriksaanKhusus();
            $khusus->porsio = $validated['porsio'];
            $khusus->uretra = $validated['uretra'];
            $khusus->vagina = $validated['vagina'];
            $khusus->vulva = $validated['vulva'];
            $khusus->fluksus = $validated['fluksus'];
            $khusus->fluor = $validated['fluor'];
            $khusus->save();

            //pemeriksaan skrining
            $skrining = new SkriningKesehatanJiwa();
            $skrining->skrining_jiwa = $validated['skrining_jiwa_tr1'];
            $skrining->tindak_lanjut_jiwa = $validated['tindak_lanjut_tr1'];
            $skrining->perlu_rujukan = $validated['rujukan_tr1'];
            $skrining->save();

            //pemeriksaan lab
            $lab = new LabTrimester1();
            $lab->hemoglobin = $validated['hemoglobin1'];
            $lab->hemoglobin_rtl = $validated['hemoglobin1_rtl'];
            $lab->golongan_darah_dan_rhesus = $validated['golDarah_rhesus'];
            $lab->rhesus_rtl = $validated['rhesus_rtl'];
            $lab->gula_darah = $validated['gulaDarah1'];
            $lab->gula_darah_rtl = $validated['gulaDarah1'];
            $lab->hiv = $validated['h'];
            $lab->sifilis = $validated['s'];
            $lab->hepatitis_b = $validated['hepatitis'];
            $lab->save();

            //usg
            $usg = new UsgTrimester1();
            $usg->keteraturan_haid = $validated['haid'];
            $usg->umur_kehamilan_berdasar_hpht = $validated['umur_kehamilan_hpht'];
            $usg->umur_kehamilan_berdasarkan_usg = $validated['umur_kehamilan_usg'];
            $usg->hpl_berdasarkan_hpht = $validated['hpl_hpht'];
            $usg->hpl_berdasarkan_usg = $validated['hpl_usg'];
            $usg->jumlah_bayi = $validated['jumlah_bayi'];
            $usg->jumlah_gs = $validated['jumlah_gs'];
            $usg->diametes_gs = $validated['diameter_gs'];
            $usg->gs_hari = $validated['gs_hari'];
            $usg->gs_minggu = $validated['gs_minggu'];
            $usg->crl = $validated['crl'];
            $usg->crl_hari = $validated['crl_hari'];
            $usg->crl_minggu = $validated['crl_minggu'];
            $usg->letak_produk_kehamilan = $validated['letak_produk'];
            $usg->pulsasi_jantung = $validated['pulsasi_jantung'];
            $usg->kecurigaan_temuan_abnormal = $validated['kecurigaan_temuan'];
            $usg->keterangan = $validated['alasan'];
            $usg->save();

            //trimester1
            $tr1 = new Trimester1();
            $tr1->pemeriksaan_id = $pemeriksaan->id;
            $tr1->skrining_kesehatan = $skrining->id;
            $tr1->pemeriksaan_fisik = $fisik->id;
            $tr1->pemeriksaan_awal = $awal->id;
            $tr1->pemeriksaan_khusus = $khusus->id;
            $tr1->lab_trimester_1 = $lab->id;
            $tr1->usg_trimester_1 = $usg->id;
            $tr1->save();

            DB::commit();
            return response()->json(['message' => 'Data berhasil disimpan'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Gagal menyimpan data', 'error' => $e->getMessage()], 500);
        }
    }
    public function trimester2(Request $request)
    {
        //
    }
    public function trimester3(Request $request)
    {
        //
    }
}
