<?php

namespace App\Http\Controllers;

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
use App\Models\Posyandu;
use App\Models\RencanaKonsultasi;
use App\Models\SkriningKesehatanJiwa;
use App\Models\Trimester1;
use App\Models\Trimester3;
use App\Models\UsgTrimester1;
use App\Models\UsgTrimester3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemeriksaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posyandus = Posyandu::all();

        return view('pemeriksaan.pemeriksaan', compact('posyandus'));
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
            case 4:
                return $this->nifas($request);
            default:
                abort(400, 'Trimester tidak valid');
        }

        return redirect()->back()->with("success", "Data berhasil ditambahkan");
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
        $riwayat = Kehamilan::find($id);

        if (!$riwayat) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'tahun' => 'required|numeric',
            'berat_badan_bayi' => 'required|numeric',
            'proses_melahirkan' => 'required|string|max:255',
            'penolong' => 'nullable|string|max:255',
            'masalah' => 'nullable|string|max:255',
            'status' => 'required|in:dalam_pemantauan,keguguran,berhasil',
        ]);

        $riwayat->tahun = $validated['tahun'];
        $riwayat->berat_badan_bayi = $validated['berat_badan_bayi'];
        $riwayat->proses_melahirkan = $validated['proses_melahirkan'];
        $riwayat->penolong = $validated['penolong'];
        $riwayat->masalah = $validated['masalah'];
        $riwayat->status = $validated['status'];

        $riwayat->update();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diperbarui.'
        ], 200);
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
            'tempat_periksa1' => 'required',
            'berat_badan1' => 'required|numeric',
            'tinggi_badan1' => 'required|numeric',
            'lingkar_lengan1' => 'required|numeric',
            'sistolik' => 'required|numeric',
            'diastolik' => 'required|numeric',
            'tinggi_rahim1' => 'nullable|string',
            'denyut_janin1' => 'nullable|string',
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
            'hpht' => 'nullable|date',
            'haid' => 'nullable|in:teratur,tidak_teratur',
            'umur_kehamilan_hpht' => 'nullable|numeric',
            'hpl_hpht' => 'nullable|date',
            'umur_kehamilan_usg' => 'nullable|numeric',
            'hpl_usg' => 'nullable|date',

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
            (auth()->user()->role == "kader") ? $pemeriksaan->kader_id = auth()->user()->id : $pemeriksaan->petugas_id = auth()->user()->id;
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
            $rutin->tablet_tambah_darah = $validated['tambah_darah1'];
            $rutin->skrining_dokter = $validated['skrining_dokter1'];
            $rutin->konseling = $validated['konseling1'];
            $rutin->save();

            //Anggota
            $anggota = Anggota::find($validated['anggota_id']);
            $anggota->update([
                'golongan_darah' => $validated['gol_darah1'],
            ]);

            //pemeriksaan awal
            $awal = new PemeriksaanAwal();
            $awal->tinggi_badan = $validated['tinggi_badan1'];
            $awal->golongan_darah = $validated['gol_darah1'];
            $awal->status_imunisasi_td = 't' . $validated['tt'];
            $awal->hemoglobin = $validated['hemoglobin1'];
            $awal->riwayat_kesehatan_ibu_sekarang = $validated['riwayat_kesehatan_ibu'] ?? [];
            $awal->riwayat_perilaku = $validated['riwayat_kesehatan'] ?? [];
            $awal->riwayat_penyakit_keluarga = $validated['riwayat_kesehatan_keluarga'] ?? [];
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
            $usg->hpht = $validated['hpht'];
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
            return redirect()->route('pemeriksaan.index')->with('success', 'Pemeriksaan berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Gagal menyimpan data', 'error' => $e->getMessage()], 500);
        }
    }
    public function trimester2(Request $request)
    {
        $validated = $request->validate([
            'anggota_id' => 'required|exists:anggota,id',

            'tanggal_periksa2' => 'required|date',
            'tempat_periksa2' => 'required|string',
            'berat_badan2' => 'required|numeric',
            'lingkar_lengan2' => 'required|numeric',
            'sistolik2' => 'required|numeric',
            'diastolik2' => 'required|numeric',
            'tinggi_rahim2' => 'nullable|string',
            'denyut_janin2' => 'nullable|string',
            'konseling2' => 'nullable|string',
            'skrining_dokter2' => 'nullable|string',
            'tambah_darah2' => 'nullable|string',
            'urine2' => 'nullable|string',
        ]);


        try {
            $kehamilan = Kehamilan::where('anggota_id', $validated['anggota_id'])->latest()->first();
            DB::beginTransaction();

            $pemeriksaan = new PemeriksaanKehamilan();
            $pemeriksaan->kehamilan_id = $kehamilan->id;
            (auth()->user()->role == "kader") ? $pemeriksaan->kader_id = auth()->user()->id : $pemeriksaan->petugas_id = auth()->user()->id;

            $pemeriksaan->tanggal_pemeriksaan = $validated['tanggal_periksa2'];
            $pemeriksaan->tempat_pemeriksaan = $validated['tempat_periksa2'];
            $pemeriksaan->jenis_pemeriksaan = 'trimester2';
            $pemeriksaan->save();

            //pemeriksaan rutin
            $rutin = new PemeriksaanRutin();
            $rutin->pemeriksaan_id = $pemeriksaan->id;
            $rutin->berat_badan = $validated['berat_badan2'];
            $rutin->tinggi_rahim = $validated['tinggi_rahim2'];
            $rutin->tekanan_darah_sistol = $validated['sistolik2'];
            $rutin->tekanan_darah_diastol = $validated['diastolik2'];
            $rutin->letak_dan_denyut_nadi_bayi = $validated['denyut_janin2'];
            $rutin->lingkar_lengan_atas = $validated['lingkar_lengan2'];
            $rutin->tablet_tambah_darah = $validated['tambah_darah2'];
            $rutin->skrining_dokter = $validated['skrining_dokter2'];
            $rutin->konseling = $validated['konseling2'];
            $rutin->protein_urin = $validated['urine2'];
            $rutin->save();

            DB::commit();
            return redirect()->route('pemeriksaan.index')->with('success', 'Pemeriksaan berhasil disimpan.');

            // return response()->json(['message' => 'Data berhasil disimpan'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Gagal menyimpan data', 'error' => $e->getMessage()], 500);
        }
    }
    public function trimester3(Request $request)
    {

        $validated = $request->validate([
            'anggota_id' => 'required|exists:anggota,id',

            'tanggal_periksa3' => 'required|date',
            'tempat_periksa3' => 'required|string',
            'berat_badan3' => 'required|numeric',
            'lingkar_lengan3' => 'required|numeric',
            'sistolik3' => 'required|numeric',
            'diastolik3' => 'required|numeric',
            'tinggi_rahim3' => 'nullable|string',
            'denyut_janin3' => 'nullable|string',
            'konseling3' => 'nullable|string',
            'skrining_dokter3' => 'nullable|string',
            'tambah_darah3' => 'nullable|string',
            'urine3' => 'nullable|string',
            'gula_darah3' => 'nullable|string',

            //pemeriksaan fisik
            'konjungtiva3' => 'nullable|in:anemia,tidak_anemia',
            'sklera3' => 'nullable|in:ikterik,tidak_ikterik',
            'kulit3' => 'nullable|in:normal,tidak_normal',
            'gigi_mulut3' => 'nullable|in:normal,tidak_normal',
            'leher3' => 'nullable|in:normal,tidak_normal',
            'tht3' => 'nullable|in:normal,tidak_normal',
            'dada3' => 'nullable|in:normal,tidak_normal',
            'jantung3' => 'nullable|in:normal,tidak_normal',
            'paru3' => 'nullable|in:normal,tidak_normal',
            'perut3' => 'nullable|in:normal,tidak_normal',
            'tungkai3' => 'nullable|in:normal,tidak_normal',

            //usg
            'usg_tr3' => 'required|in:ya,tidak',
            'umur_kehamilan_usg3' => 'required|numeric|min:1',
            'umur_kehamilan_hpht3' => 'required|numeric|min:1',
            'umur_kehamilan_biometrik3' => 'required|numeric|min:1',
            'selisih_3_minggu' => 'required|in:ya,tidak',
            'jumlah_bayi3' => 'required|in:tunggal,kembar',
            'letak3' => 'required|string',
            'presentasi3' => 'required|string',
            'keadaan3' => 'required|in:hidup,meninggal',
            'djj3' => 'required|numeric|min:1',
            'djj_status3' => 'required|in:normal,tidak_normal',
            'lokasi_plasenta3' => 'required|string',
            'sdp3' => 'required|numeric|min:1',
            'jumlah_ketuban3' => 'required|in:cukup,kurang,banyak',
            'bpd3' => 'required|numeric|min:1',
            'bpd_minggu3' => 'required|numeric|min:1',
            'hc3' => 'required|numeric|min:1',
            'hc_minggu3' => 'required|numeric|min:1',
            'ac3' => 'required|numeric|min:1',
            'ac_minggu3' => 'required|numeric|min:1',
            'fl3' => 'required|numeric|min:1',
            'fl_minggu3' => 'required|numeric|min:1',
            'efw3' => 'required|numeric|min:1',
            'efw_minggu3' => 'required|numeric|min:1',
            'kecurigaan3' => 'required|in:ya,tidak',
            'alasan3' => 'nullable|string|max:255',

            //lab
            'hemoglobin3' => 'required|numeric|min:1',
            'hemoglobin_rtl3' => 'nullable|string|max:255',
            'protein_urin3' => 'required|string|max:255',
            'protein_urin_rtl3' => 'nullable|string|max:255',
            'urine_reduksi' => 'required',
            'urin_reduksi_rtl3' => 'nullable|string|max:255',

            //skrining
            'skrining_jiwa_tr3' => 'required|in:ya,tidak',
            'tindak_lanjut_tr3' => 'required|in:edukasi,konseling',
            'rujukan_tr3' => 'required|in:ya,tidak',

            //konsultasi
            'rencana_konsultasi' => 'required|array',
            'rencana_melahirkan' => 'required|in:normal,sectio_caesaria,pervaginam_berbantu',
            'kontrasepsi' => 'required|in:AKDR,Pil,Suntik,Steril,MAL,Implan,belum_memilih',
            'kebutuhan_konseling' => 'required|in:ya,tidak',

        ]);

        try {
            $kehamilan = Kehamilan::where('anggota_id', $validated['anggota_id'])->latest()->first();
            DB::beginTransaction();

            $pemeriksaan = new PemeriksaanKehamilan();
            $pemeriksaan->kehamilan_id = $kehamilan->id;
            (auth()->user()->role == "kader") ? $pemeriksaan->kader_id = auth()->user()->id : $pemeriksaan->petugas_id = auth()->user()->id;
            $pemeriksaan->tanggal_pemeriksaan = $validated['tanggal_periksa3'];
            $pemeriksaan->tempat_pemeriksaan = $validated['tempat_periksa3'];
            $pemeriksaan->jenis_pemeriksaan = 'trimester3';
            $pemeriksaan->save();

            //pemeriksaan rutin
            $rutin = new PemeriksaanRutin();
            $rutin->pemeriksaan_id = $pemeriksaan->id;
            $rutin->berat_badan = $validated['berat_badan3'];
            $rutin->tinggi_rahim = $validated['tinggi_rahim3'];
            $rutin->tekanan_darah_sistol = $validated['sistolik3'];
            $rutin->tekanan_darah_diastol = $validated['diastolik3'];
            $rutin->letak_dan_denyut_nadi_bayi = $validated['denyut_janin3'];
            $rutin->lingkar_lengan_atas = $validated['lingkar_lengan3'];
            $rutin->tablet_tambah_darah = $validated['tambah_darah3'];
            $rutin->skrining_dokter = $validated['skrining_dokter3'];
            $rutin->konseling = $validated['konseling3'];
            $rutin->protein_urin = $validated['urine3'];
            $rutin->tes_lab_gula_darah = $validated['gula_darah3'];
            $rutin->save();

            //pemeriksaan fisik
            $fisik = new PemeriksaanFisik();
            $fisik->konjungtiva = $validated['konjungtiva3'];
            $fisik->sklera = $validated['sklera3'];
            $fisik->kulit = $validated['kulit3'];
            $fisik->leher = $validated['leher3'];
            $fisik->gigi_mulut = $validated['gigi_mulut3'];
            $fisik->tht = $validated['tht3'];
            $fisik->jantung = $validated['jantung3'];
            $fisik->paru = $validated['paru3'];
            $fisik->perut = $validated['perut3'];
            $fisik->tungkai = $validated['tungkai3'];
            $fisik->save();

            //skrining
            $skrining = new SkriningKesehatanJiwa();
            $skrining->skrining_jiwa = $validated['skrining_jiwa_tr3'];
            $skrining->tindak_lanjut_jiwa = $validated['tindak_lanjut_tr3'];
            $skrining->perlu_rujukan = $validated['rujukan_tr3'];
            $skrining->save();

            //usg
            $usg = new UsgTrimester3();
            $usg->usg_trimester3 = $validated['usg_tr3'];
            $usg->umur_kehamilan_usg_trimester_1 = $validated['umur_kehamilan_usg3'] ?? $validated['umur_kehamilan_hpht3'];
            $usg->umur_kehamilan_usg_trimester_3 = $validated['umur_kehamilan_biometrik3'];
            $usg->selisih_uk_usg_1_hpht_dengan_trimester_3 = $validated['selisih_3_minggu'];
            $usg->jumlah_bayi = $validated['jumlah_bayi3'];
            $usg->letak_bayi = $validated['letak3'];
            $usg->presentasi_bayi = $validated['presentasi3'];
            $usg->keadaan_bayi = $validated['keadaan3'];
            $usg->djj = $validated['djj3'];
            $usg->djj_status = $validated['djj_status3'];
            $usg->sdp = $validated['sdp3'];
            $usg->lokasi_plasenta = $validated['lokasi_plasenta3'];
            $usg->jumlah_cairan_ketuban = $validated['jumlah_ketuban3'];
            $usg->BPD = $validated['bpd3'];
            $usg->BPD_Sesuai_Minggu = $validated['bpd_minggu3'];
            $usg->HC = $validated['hc3'];
            $usg->HC_Sesuai_Minggu = $validated['hc_minggu3'];
            $usg->AC = $validated['ac3'];
            $usg->AC_Sesuai_Minggu = $validated['ac_minggu3'];
            $usg->FL = $validated['fl3'];
            $usg->FL_Sesuai_Minggu = $validated['fl_minggu3'];
            $usg->EFW = $validated['efw3'];
            $usg->EFW_Sesuai_Minggu = $validated['efw_minggu3'];
            $usg->kecurigaan_temuan_abnormal = $validated['kecurigaan3'];
            $usg->keterangan = $validated['alasan3'];
            $usg->save();

            //lab
            $lab = new LabTrimester3();
            $lab->Hemoglobin = $validated['hemoglobin3'];
            $lab->Protein_urin = $validated['protein_urin3'];
            $lab->urin_reduksi = $validated['urine_reduksi'];
            $lab->hemoglobin_rtl = $validated['hemoglobin_rtl3'];
            $lab->protein_urin_rtl = $validated['protein_urin_rtl3'];
            $lab->urin_reduksi_rtl = $validated['urin_reduksi_rtl3'];
            $lab->save();

            //konsultasi
            $konsultasi = new RencanaKonsultasi();
            $konsultasi->rencana_konsultasi_lanjut = $validated['rencana_konsultasi'];
            $konsultasi->rencana_proses_melahirkan = $validated['rencana_melahirkan'];
            $konsultasi->pilihan_kontrasepsi = $validated['kontrasepsi'];
            $konsultasi->kebutuhan_konseling = $validated['kebutuhan_konseling'];
            $konsultasi->save();

            //tr3
            $tr3 = new Trimester3();
            $tr3->pemeriksaan_id = $pemeriksaan->id;
            $tr3->skrining_kesehatan = $skrining->id;
            $tr3->pemeriksaan_fisik = $fisik->id;
            $tr3->lab_trimester_3 = $lab->id;
            $tr3->usg_trimester_3 = $usg->id;
            $tr3->rencana_konsultasi = $konsultasi->id;
            $tr3->save();

            DB::commit();
            return redirect()->route('pemeriksaan.index')->with('success', 'Pemeriksaan berhasil disimpan.');
            // return response()->json(['message' => 'Data berhasil disimpan'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Gagal menyimpan data', 'error' => $e->getMessage()], 500);
        }
    }

    public function nifas(Request $request)
    {

        $validated = $request->validate([
            'anggota_id' => 'required|exists:anggota,id',

            'bagian_kf' => 'required|in:kf1,kf2,kf3,kf4,kf5',
            'tanggal_pemeriksaan_nifas' => 'required|date',
            'tempat_periksa_nifas' => 'required|string|max:255',

            'periksa_payudara' => 'nullable|string|max:500',
            'periksa_pendarahan' => 'nullable|string|max:500',
            'periksa_jalan_lahir' => 'nullable|string|max:500',

            'vitamin_a' => 'nullable|string|max:255',
            'kb_pasca_melahirkan' => 'nullable|string|max:255',
            'skrining_kesehatan_jiwa' => 'nullable|string|max:255',
            'konseling' => 'nullable|string|max:255',
            'tata_laksana_kasus' => 'nullable|string|max:255',

            'kesimpulan_ibu' => 'nullable|array',
            'kesimpulan_bayi' => 'nullable|array',
            'masalah_nifas' => 'nullable|array',

            'kesimpulan' => 'nullable|string|max:500',
        ]);

        try {
            $kehamilan = Kehamilan::where('anggota_id', $validated['anggota_id'])->latest()->first();
            DB::beginTransaction();

            $pemeriksaan = new PemeriksaanKehamilan();
            $pemeriksaan->kehamilan_id = $kehamilan->id;
            (auth()->user()->role === "kader") ? $pemeriksaan->kader_id = auth()->user()->id : $pemeriksaan->petugas_id = auth()->user()->id;
            $pemeriksaan->tanggal_pemeriksaan = $validated['tanggal_pemeriksaan_nifas'];
            $pemeriksaan->tempat_pemeriksaan = $validated['tempat_periksa_nifas'];
            $pemeriksaan->jenis_pemeriksaan = 'nifas';

            $pemeriksaan->save();

            $nifas = new Nifas();
            $nifas->pemeriksaan_id = $pemeriksaan->id;
            $nifas->bagian_kf = $validated['bagian_kf'];
            $nifas->periksa_payudara = $validated['periksa_payudara'];
            $nifas->periksa_pendarahan = $validated['periksa_pendarahan'];
            $nifas->periksa_jalan_lahir = $validated['periksa_jalan_lahir'];
            $nifas->vitamin_a = $validated['vitamin_a'];
            $nifas->kb_pasca_melahirkan = $validated['kb_pasca_melahirkan'];
            $nifas->skrining_kesehatan_jiwa = $validated['skrining_kesehatan_jiwa'];
            $nifas->konseling = $validated['konseling'];
            $nifas->tata_laksana_kasus = $validated['tata_laksana_kasus'];
            $nifas->kesimpulan_ibu = isset($validated['kesimpulan_ibu']) ? implode(',', $validated['kesimpulan_ibu']) : null;
            $nifas->kesimpulan_bayi = isset($validated['kesimpulan_bayi']) ? implode(',', $validated['kesimpulan_bayi']) : null;
            $nifas->masalah_nifas = isset($validated['masalah_nifas']) ? implode(',', $validated['masalah_nifas']) : null;
            $nifas->kesimpulan = $validated['kesimpulan'];
            $nifas->save();

            DB::commit();
            return redirect()->route('pemeriksaan.index')->with('success', 'Pemeriksaan berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
        }
    }
}
