@extends('layouts.app')
@section('main')
    <section class="mt-0 mb-10">
        <div class="mx-auto max-w-screen-xl">
            <div class="bg-white shadow-md sm:rounded-lg overflow-hidden">

                <div class="card bg-info-subtle shadow-none mb-4">
                    <div class="card-body px-4 py-3">
                        <h4 class="fw-semibold mb-2">Pemeriksaan Kesehatan</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Pelayanan
                                        Posyandu</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Pemeriksaan Kesehatan</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="d-flex gap-2 mb-4">
                    <button type="button" class="btn btn-outline-primary btn-toggle-form active"
                        onclick="showForm('form-trimester-1')">Trimester 1</button>
                    <button type="button" class="btn btn-outline-primary btn-toggle-form"
                        onclick="showForm('form-trimester-2')">Trimester 2</button>
                    <button type="button" class="btn btn-outline-primary btn-toggle-form"
                        onclick="showForm('form-trimester-3')">Trimester 3</button>
                    <div class="flex-grow-1"></div>
                    <div class="input-group" style="max-width: 300px;">
                        <div class="input-group">
                            <input type="text" name="anggota" class="form-control" placeholder=" Nama Anggota"
                                aria-describedby="icon-anggota">
                            <span class="input-group-text" id="icon-anggota">
                                <i class="ti ti-search"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card card-body border">
                    <div id="form-trimester-1" class="form-section">
                        <form action="{{ route('pemeriksaan.index') }}" method="POST" id="formTrimester1">
                            @csrf
                            <input type="hidden" name="id_form" id="id_form" value="1">
                            <div class="step-section" id="step-1">
                                <div class="row g-3">
                                    <h5>Catatan Pemeriksaan</h5>
                                    <div class="col-md-6">
                                        <label class="form-label">Tanggal Periksa</label>
                                        <input type="date" name="tanggal_periksa" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tempat Periksa</label>
                                        <input type="text" name="tempat_eriksa" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Timbang BB</label>
                                        <div class="input-group">
                                            <input type="text" name="berat_badan" class="form-control">
                                            <span class="input-group-text">Kg</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Pengukuran Tinggi Badan</label>
                                        <div class="input-group">
                                            <input type="text" name="tinggi_badan" class="form-control">
                                            <span class="input-group-text">Cm</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Ukur Lingkar Lengan Atas</label>
                                        <input type="text" name="lingkar_lengan" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tekanan Darah</label>
                                        <div class="input-group">
                                            <input type="text" name="tekanan_darah" class="form-control">
                                            <span class="input-group-text">mmHg</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Periksa Tinggi Rahim</label>
                                        <input type="text" name="tinggi_rahim" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Letak dan Denyut Jantung Janin</label>
                                        <input type="text" name="denyut_janin" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Status dan Imunisasi Tetanus</label>
                                        <input type="text" name="imunisasi_tetanus" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Konseling</label>
                                        <input type="text" name="konseling" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Skrining Dokter</label>
                                        <input type="text" name="skrining_dokter" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tablet Tambah Darah</label>
                                        <input type="text" name="tambah_darah" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tes Golongan Darah</label>
                                        <input type="text" name="gol_darah" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="step-section d-none" id="step-2">
                                <div class="row g-3">
                                    <h5>Riwayat Kesehatan Ibu Sekarang</h5>
                                    <div class="col-md-12 mb-4">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan[]" value="Alergi" id="alergi">
                                                    <label class="form-check-label" for="alergi">Alergi</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan[]" value="Asma" id="asma">
                                                    <label class="form-check-label" for="asma">Asma</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan[]" value="Autoimun" id="autoimun">
                                                    <label class="form-check-label" for="autoimun">Autoimun</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan[]" value="Diabetes" id="diabetes">
                                                    <label class="form-check-label" for="diabetes">Diabetes</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan[]" value="Hepatitis B" id="hepatitisB">
                                                    <label class="form-check-label" for="hepatitisB">Hepatitis B</label>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan[]" value="Hipertensi" id="hipertensi">
                                                    <label class="form-check-label" for="hipertensi">Hipertensi</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan[]" value="Jantung" id="jantung">
                                                    <label class="form-check-label" for="jantung">Jantung</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan[]" value="Jiwa" id="jiwa">
                                                    <label class="form-check-label" for="jiwa">Jiwa</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan[]" value="Sifilis" id="sifilis">
                                                    <label class="form-check-label" for="sifilis">Sifilis</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan[]" value="TB" id="tb">
                                                    <label class="form-check-label" for="tb">TB</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 mt-4">
                                    <h5>Riwayat Perilaku Berisiko 1 Bulan Sebelum Hamil</h5>
                                    <div class="col-md-12 mb-4">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan[]" value="Aktifitas_fisik"
                                                        id="fisik">
                                                    <label class="form-check-label" for="fisik">Aktivitas fisik kurang
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan[]" value="Alkohol" id="alkohol">
                                                    <label class="form-check-label" for="alkohol">Alkohol</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan[]" value="rokok" id="Rokok">
                                                    <label class="form-check-label" for="Rokok">Merokok</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan[]" value="Kosemtik_berbahaya"
                                                        id="kosmetik">
                                                    <label class="form-check-label" for="kosmetik">Kosmetik yang
                                                        mengandung zat berbahaya</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan[]" value="obat" id="Obat">
                                                    <label class="form-check-label" for="Obat">Obat
                                                        Teratogenik</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan[]" value="pola_makan" id="pola_makan">
                                                    <label class="form-check-label" for="pola_makan">Pola makan
                                                        berisiko</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 mt-4">
                                    <h5>Riwayat Penyakit Keluarga</h5>
                                    <div class="col-md-12 mb-4">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan[]" value="Alergi" id="alergi">
                                                    <label class="form-check-label" for="alergi">Alergi</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan[]" value="Asma" id="asma">
                                                    <label class="form-check-label" for="asma">Asma</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan[]" value="Autoimun" id="autoimun">
                                                    <label class="form-check-label" for="autoimun">Autoimun</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan[]" value="Diabetes" id="diabetes">
                                                    <label class="form-check-label" for="diabetes">Diabetes</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan[]" value="Hepatitis B" id="hepatitisB">
                                                    <label class="form-check-label" for="hepatitisB">Hepatitis B</label>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan[]" value="Hipertensi" id="hipertensi">
                                                    <label class="form-check-label" for="hipertensi">Hipertensi</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan[]" value="Jantung" id="jantung">
                                                    <label class="form-check-label" for="jantung">Jantung</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan[]" value="Jiwa" id="jiwa">
                                                    <label class="form-check-label" for="jiwa">Jiwa</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan[]" value="Sifilis" id="sifilis">
                                                    <label class="form-check-label" for="sifilis">Sifilis</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan[]" value="TB" id="tb">
                                                    <label class="form-check-label" for="tb">TB</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 mt-4">
                                    <h5>Status Imunisasi TD</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Pilih</th>
                                                    <th>TT</th>
                                                    <th>Selang Waktu</th>
                                                    <th>Perlindungan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input type="radio" name="tt" value="1"></td>
                                                    <td>1</td>
                                                    <td>-</td>
                                                    <td>Awal</td>
                                                </tr>
                                                <tr>
                                                    <td><input type="radio" name="tt" value="2"></td>
                                                    <td>2</td>
                                                    <td>1 bulan</td>
                                                    <td>3 tahun</td>
                                                </tr>
                                                <tr>
                                                    <td><input type="radio" name="tt" value="3"></td>
                                                    <td>3</td>
                                                    <td>6 bulan</td>
                                                    <td>5 tahun</td>
                                                </tr>
                                                <tr>
                                                    <td><input type="radio" name="tt" value="4"></td>
                                                    <td>4</td>
                                                    <td>12 bulan</td>
                                                    <td>10 tahun</td>
                                                </tr>
                                                <tr>
                                                    <td><input type="radio" name="tt" value="5"></td>
                                                    <td>5</td>
                                                    <td>12 bulan</td>
                                                    <td>> 25 tahun</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row g-3 mt-2">
                                    <h5>Pemeriksaan Khusus</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm text-center align-middle">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th rowspan="2"
                                                        style="text-align: center; vertical-align: middle;">Inspeksi /
                                                        Inspekulo</th>
                                                    <th colspan="2">Kondisi</th>
                                                </tr>
                                                <tr>
                                                    <th>Normal / (+)</th>
                                                    <th>Tidak Normal / (-)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Porsio</td>
                                                    <td><input type="radio" name="porsio" value="normal"></td>
                                                    <td><input type="radio" name="porsio" value="tidak_normal"></td>
                                                </tr>
                                                <tr>
                                                    <td>Uretra</td>
                                                    <td><input type="radio" name="uretra" value="normal"></td>
                                                    <td><input type="radio" name="uretra" value="tidak_normal"></td>
                                                </tr>
                                                <tr>
                                                    <td>Vagina</td>
                                                    <td><input type="radio" name="vagina" value="normal"></td>
                                                    <td><input type="radio" name="vagina" value="tidak_normal"></td>
                                                </tr>
                                                <tr>
                                                    <td>Vulva</td>
                                                    <td><input type="radio" name="vulva" value="normal"></td>
                                                    <td><input type="radio" name="vulva" value="tidak_normal"></td>
                                                </tr>
                                                <tr>
                                                    <td>Fluksus</td>
                                                    <td><input type="radio" name="fluksus" value="positif"></td>
                                                    <td><input type="radio" name="fluksus" value="negatif"></td>
                                                </tr>
                                                <tr>
                                                    <td>Fluor</td>
                                                    <td><input type="radio" name="fluor" value="positif"></td>
                                                    <td><input type="radio" name="fluor" value="negatif"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row g-3 mt-4">
                                    <h5>Riwayat Kehamilan dan Proses Melahirkan</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered align-middle text-center">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tahun</th>
                                                    <th>BB <small>gram</small></th>
                                                    <th>Proses Melahirkan</th>
                                                    <th>Penolong Proses Melahirkan</th>
                                                    <th>Masalah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td><input type="text" name="tahun1"
                                                            class="form-control form-control-sm"></td>
                                                    <td><input type="number" name="bb1"
                                                            class="form-control form-control-sm"></td>
                                                    <td>
                                                        <select name="proses1" class="form-select form-select-sm">
                                                            <option value="">-- Pilih --</option>
                                                            <option value="normal">Puskesmas</option>
                                                            <option value="operasi">Rumah Sakit</option>
                                                            <option value="vakum">Bidan</option>
                                                            <option value="lainnya">Lainnya</option>
                                                        </select>
                                                    </td>
                                                    <td><input type="text" name="penolong1"
                                                            class="form-control form-control-sm"></td>
                                                    <td><input type="text" name="masalah1"
                                                            class="form-control form-control-sm"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="step-section d-none" id="step-3">
                                <div class="row g-3 mb-2">
                                    <h5>Pemeriksaan Fisik</h5>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered text-center align-middle">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th rowspan="2"
                                                        style="text-align: center; vertical-align: middle;">Keadaan Umum
                                                    </th>
                                                    <th colspan="2">Kondisi</th>
                                                </tr>
                                                <tr>
                                                    <th>Anemia / Ikteria /Normal</th>
                                                    <th>Tidak Anemia / Tidak Ikteria / Tidak Normal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Konjungtiva</td>
                                                    <td><input type="radio" name="konjungtiva" value="normal"></td>
                                                    <td><input type="radio" name="konjungtiva" value="tidak_normal">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Sklera</td>
                                                    <td><input type="radio" name="sklera" value="normal"></td>
                                                    <td><input type="radio" name="sklera" value="tidak_normal"></td>
                                                </tr>
                                                <tr>
                                                    <td>Kulit</td>
                                                    <td><input type="radio" name="vagina" value="normal"></td>
                                                    <td><input type="radio" name="vagina" value="tidak_normal"></td>
                                                </tr>
                                                <tr>
                                                    <td>Leher</td>
                                                    <td><input type="radio" name="leher" value="normal"></td>
                                                    <td><input type="radio" name="leher" value="tidak_normal"></td>
                                                </tr>
                                                <tr>
                                                    <td>Gigi Mulut </td>
                                                    <td><input type="radio" name="gigi_mulut" value="normal"></td>
                                                    <td><input type="radio" name="gigi_mulut" value="tidak_normal">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>THT</td>
                                                    <td><input type="radio" name="tht" value="normal"></td>
                                                    <td><input type="radio" name="tht" value="tidak_normal"></td>
                                                </tr>
                                                <tr>
                                                    <td>Dada</td>
                                                    <td><input type="radio" name="dada" value="normal"></td>
                                                    <td><input type="radio" name="dada" value="tidak_normal"></td>
                                                </tr>
                                                <tr>
                                                    <td>Jantung</td>
                                                    <td><input type="radio" name="jantung" value="normal"></td>
                                                    <td><input type="radio" name="jantung" value="tidak_normal"></td>
                                                </tr>
                                                <tr>
                                                    <td>Paru</td>
                                                    <td><input type="radio" name="paru" value="normal"></td>
                                                    <td><input type="radio" name="paru" value="tidak_normal"></td>
                                                </tr>
                                                <tr>
                                                    <td>Perut</td>
                                                    <td><input type="radio" name="perut" value="positif"></td>
                                                    <td><input type="radio" name="perut" value="tidak_normal"></td>
                                                </tr>
                                                <tr>
                                                    <td>Tungkai</td>
                                                    <td><input type="radio" name="tungkai" value="positif"></td>
                                                    <td><input type="radio" name="tungkai" value="tidak_normal"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <h5>USG Trimester 1</h5>
                                    <form>
                                        <div style="margin-bottom: 12px; display: flex; align-items: center;">
                                            <label for="hpht" style="width: 300px; font-weight: normal;">HPHT</label>
                                            <input type="text" id="hpht" name="hpht"
                                                style="flex: 1; padding: 5px; border: 1px solid #ccc; border-radius: 7px;">
                                        </div>

                                        <div style="margin-bottom: 12px; display: flex; align-items: center;">
                                            <label for="haid" style="width: 300px; font-weight: normal;">
                                                Keteraturan haid: (Teratur/Tidak Teratur)
                                            </label>
                                            <select id="haid" name="haid"
                                                style="flex: 1; padding: 5px; border: 1px solid #ccc; border-radius: 7px;">
                                                <option value="" disabled selected>Pilih</option>
                                                <option value="teratur">Teratur</option>
                                                <option value="tidak_teratur">Tidak Teratur</option>
                                            </select>
                                        </div>

                                        <div style="margin-bottom: 12px; display: flex; align-items: center;">
                                            <label for="umur_kehamilan_hpht" style="width: 300px; font-weight: normal;">
                                                Umur kehamilan berdasarkan HPHT (pada siklus haid teratur)
                                            </label>
                                            <input type="text" id="umur_kehamilan_hpht" name="umur_kehamilan_hpht"
                                                style="width: 60px; padding: 5px; margin-right: 5px; border: 1px solid #ccc; border-radius: 7px;">
                                            <span>Minggu</span>
                                        </div>

                                        <div style="margin-bottom: 12px; display: flex; align-items: center;">
                                            <label for="hpl_hpht" style="width: 300px; font-weight: normal;">
                                                HPL Berdasarkan HPHT (pada siklus haid teratur)
                                            </label>
                                            <input type="text" id="hpl_hpht" name="hpl_hpht"
                                                style="flex: 1; padding: 5px; border: 1px solid #ccc; border-radius: 7px;">
                                        </div>

                                        <div style="margin-bottom: 12px; display: flex; align-items: center;">
                                            <label for="umur_kehamilan_usg" style="width: 300px; font-weight: normal;">
                                                Umur kehamilan berdasarkan USG
                                            </label>
                                            <input type="text" id="umur_kehamilan_usg" name="umur_kehamilan_usg"
                                                style="width: 60px; padding: 5px; margin-right: 5px; border: 1px solid #ccc; border-radius: 7px;">
                                            <span>Minggu</span>
                                        </div>

                                        <div style="margin-bottom: 12px; display: flex; align-items: center;">
                                            <label for="hpl_usg" style="width: 300px; font-weight: normal;">
                                                HPL berdasarkan USG
                                            </label>
                                            <input type="text" id="hpl_usg" name="hpl_usg"
                                                style="flex: 1; padding: 5px; border: 1px solid #ccc; border-radius: 7px;">
                                        </div>
                                    </form>
                                    <div class="table-responsive">
                                        <table class="table table-bordered align-middle text-start">
                                            <tbody>
                                                <tr>
                                                    <td class="table-dark text-white">Jumlah GS</td>
                                                    <td>
                                                        <select class="form-select">
                                                            <option>Tunggal</option>
                                                            <option>Kembar</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="table-dark text-white">Diameter GS</td>
                                                    <td>
                                                        <input type="text" class="form-control mb-2"
                                                            placeholder="... cm">
                                                        <span class="d-block mb-1">Sesuai dengan umur kehamilan:</span>
                                                        <div class="input-group mb-1">
                                                            <input type="number" class="form-control"
                                                                placeholder="... minggu">
                                                            <span class="input-group-text">Minggu</span>
                                                            <input type="number" class="form-control"
                                                                placeholder="... hari">
                                                            <span class="input-group-text">Hari</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="table-dark text-white">Jumlah Bayi</td>
                                                    <td>
                                                        <select class="form-select">
                                                            <option>Tunggal</option>
                                                            <option>Kembar</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="table-dark text-white">CRL</td>
                                                    <td>
                                                        <input type="text" class="form-control mb-2"
                                                            placeholder="... cm">
                                                        <span class="d-block mb-1">Sesuai dengan umur kehamilan:</span>
                                                        <div class="input-group mb-1">
                                                            <input type="number" class="form-control"
                                                                placeholder="... minggu">
                                                            <span class="input-group-text">Minggu</span>
                                                            <input type="number" class="form-control"
                                                                placeholder="... hari">
                                                            <span class="input-group-text">Hari</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="table-dark text-white">Letak Produk Kehamilan</td>
                                                    <td>
                                                        <select class="form-select">
                                                            <option>Intrauterin</option>
                                                            <option>Extrauterin</option>
                                                            <option>Tidak dapat ditentukan</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="table-dark text-white">Pulsasi Jantung</td>
                                                    <td>
                                                        <select class="form-select">
                                                            <option>Tampak</option>
                                                            <option>Tidak tampak</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="table-dark text-white">Kecurigaan Temuan Abnormal</td>
                                                    <td>
                                                        <select class="form-select mb-2">
                                                            <option>Ya</option>
                                                            <option>Tidak</option>
                                                        </select>
                                                        <input type="text" class="form-control"
                                                            placeholder="Sebutkan jika ada...">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <div class="step-section d-none" id="step-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h5 class="mb-0">Pemeriksaan Laboratorium</h5>
                                    <div class="d-flex align-items-center">
                                        <label class="me-2 mb-0">Tanggal:</label>
                                        <input type="text" class="form-control form-control-sm" style="width: 150px;">
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="table-responsive">
                                        <table class="table table-bordered align-middle text-center">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Pemeriksaan</th>
                                                    <th>Hasil</th>
                                                    <th>Rencana Tindak Lanjut</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-start">Hemoglobin</td>
                                                    <td>
                                                        <div class="input-group input-group-sm">
                                                            <input type="number" class="form-control"
                                                                placeholder="Nilai">
                                                            <span class="input-group-text">g/dL</span>
                                                        </div>
                                                    </td>
                                                    <td><input type="text" class="form-control form-control-sm"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-start">Golongan Darah & Rhesus</td>
                                                    <td><input type="text" class="form-control form-control-sm"></td>
                                                    <td><input type="text" class="form-control form-control-sm"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-start">Gula Darah Sewaktu</td>
                                                    <td>
                                                        <div class="input-group input-group-sm">
                                                            <input type="number" class="form-control"
                                                                placeholder="Nilai">
                                                            <span class="input-group-text">Mg/dL</span>
                                                        </div>
                                                    </td>
                                                    <td><input type="text" class="form-control form-control-sm"></td>
                                                </tr>
                                                <tr class="table">
                                                    <td class="text-start" colspan="3"><strong>Tripel
                                                            Eliminasi</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-start">H</td>
                                                    <td>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="h"
                                                                value="reaktif">
                                                            <label class="form-check-label">Reaktif</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="h"
                                                                value="non-reaktif">
                                                            <label class="form-check-label">Non reaktif</label>
                                                        </div>
                                                    </td>
                                                    <td><input type="text" class="form-control form-control-sm"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-start">S</td>
                                                    <td>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="s"
                                                                value="reaktif">
                                                            <label class="form-check-label">Reaktif</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="s"
                                                                value="non-reaktif">
                                                            <label class="form-check-label">Non reaktif</label>
                                                        </div>
                                                    </td>
                                                    <td><input type="text" class="form-control form-control-sm"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-start">Hepatitis B</td>
                                                    <td>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="hepatitis" value="reaktif">
                                                            <label class="form-check-label">Reaktif</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="hepatitis" value="non-reaktif">
                                                            <label class="form-check-label">Non reaktif</label>
                                                        </div>
                                                    </td>
                                                    <td><input type="text" class="form-control form-control-sm"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row g-3 mt-4">
                                        <h5>Skrining Kesehatan Jiwa</h5>
                                        <div class="table-responsive">
                                            <table class="table table-bordered text-center align-middle">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-start">Skrining Kesehatan Jiwa</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="skrining_jiwa" value="ya" id="skrining_ya">
                                                                <label class="form-check-label"
                                                                    for="skrining_ya">Ya</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="skrining_jiwa" value="tidak"
                                                                    id="skrining_tidak">
                                                                <label class="form-check-label"
                                                                    for="skrining_tidak">Tidak</label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-start">Tindak Lanjut Hasil Skrining Kesehatan Jiwa
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="tindak_lanjut" value="edukasi" id="edukasi">
                                                                <label class="form-check-label"
                                                                    for="edukasi">Edukasi</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="tindak_lanjut" value="konseling"
                                                                    id="konseling">
                                                                <label class="form-check-label"
                                                                    for="konseling">Konseling</label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-start">Perlu Rujukan</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="rujukan" value="ya" id="rujukan_ya">
                                                                <label class="form-check-label"
                                                                    for="rujukan_ya">Ya</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="rujukan" value="tidak" id="rujukan_tidak">
                                                                <label class="form-check-label"
                                                                    for="rujukan_tidak">Tidak</label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="form-trimester-2" class="form-section d-none">
                                <form action="{{ route('pemeriksaan.index') }}" method="POST" id="formTrimester2">
                                    @csrf
                                    <div class="step-section" id="step-1">
                                        <div class="row g-3">

                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="form-trimester-3" class="form-section d-none">
                                <form action="{{ route('pemeriksaan.index') }}" method="POST" id="formTrimester3">
                                    @csrf
                                    <div class="step-section" id="step-1">
                                    </div>
                                </form>
                            </div>
                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <button type="button" class="btn btn-danger" id="btnKembali"
                                    style="display:none;">Kembali</button>
                                <button type="button" class="btn btn-primary" id="btnLanjutkan">Lanjutkan</button>
                            </div>
                    </div>
                </div>
                </form>
            </div>

        </div>
        </div>
        </div>
    </section>
    <script>
        function showForm(formId) {
            // Sembunyikan semua form
            document.querySelectorAll('.form-section').forEach(function(section) {
                section.classList.add('d-none');
            });
            document.getElementById(formId).classList.remove('d-none');
            document.querySelectorAll('.btn-toggle-form').forEach(function(btn) {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');
            currentStep = 1
            showStep(currentStep);
        }
    </script>
    <script>
        let currentStep = 1;
        const totalSteps = document.querySelectorAll('#form-trimester-1 .step-section').length;

        const btnLanjutkan = document.getElementById('btnLanjutkan');
        const btnKembali = document.getElementById('btnKembali');

        function showStep(step) {
            // Sembunyikan semua step
            document.querySelectorAll('#form-trimester-1 .step-section').forEach(section => {
                section.classList.add('d-none');
            });
            document.getElementById('step-' + step).classList.remove('d-none');

            if (step === 1) {
                btnKembali.style.display = 'none';
            } else {
                btnKembali.style.display = 'inline-block';
            }
            console.log(step, totalSteps);

            if (step === totalSteps) {
                btnLanjutkan.textContent = 'Selesai';
                btnLanjutkan.type = 'submit';
            } else {
                btnLanjutkan.textContent = 'Lanjutkan';
                btnLanjutkan.type = 'button';
            }
        }

        btnLanjutkan.addEventListener('click', function() {
            if (currentStep < totalSteps) {
                currentStep++;
                showStep(currentStep);
            } else {}
        });

        btnKembali.addEventListener('click', function() {
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
            }
        });
        showStep(currentStep);
    </script>
@endsection
