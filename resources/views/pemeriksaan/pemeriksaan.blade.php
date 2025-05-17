@extends('layouts.app')
@section('main')
    <style>
        #suggestion-box {
            border-top: none;
            border-bottom-left-radius: 0.375rem;
            border-bottom-right-radius: 0.375rem;
            background-color: white;
            color: black;
        }

        #suggestion-box .dropdown-item {
            padding: 0.5rem 1rem;
            cursor: pointer;
        }
    </style>
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
                        onclick="showForm('form-trimester-1', 1)">Trimester 1</button>
                    <button type="button" class="btn btn-outline-primary btn-toggle-form"
                        onclick="showForm('form-trimester-2', 2)">Trimester 2</button>
                    <button type="button" class="btn btn-outline-primary btn-toggle-form"
                        onclick="showForm('form-trimester-3', 3)">Trimester 3</button>
                    <div class="flex-grow-1"></div>
                    <div class="position-relative" style="max-width: 300px;">
                        <div class="input-group">
                            <input type="text" class="form-control" id="input-anggota" placeholder="Nama Anggota"
                                autocomplete="off">
                            <span class="input-group-text"><i class="ti ti-search"></i></span>
                        </div>
                        <div id="suggestion-box"
                            style="position: absolute; top: 100%; left: 0; right: 0; max-height: 200px; overflow-y: auto; z-index: 1000; background-color: gray; color: white;">
                        </div>
                    </div>
                </div>
                <div class="card card-body border">
                    <form action="{{ route('pemeriksaan.store') }}" method="POST" id="formTrimester1">
                        <div id="form-trimester-1" class="form-section">
                            @csrf
                            <input type="hidden" name="anggota_id" id="anggota-id">
                            <div class="step-section step-1" id="">
                                <div class="row g-3">
                                    <h5>Catatan Pemeriksaan</h5>
                                    <div class="col-md-6">
                                        <label class="form-label">Tanggal Periksa</label>
                                        <input type="date" name="tanggal_periksa1" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tempat Periksa</label>
                                        <input type="text" name="tempat_periksa1" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Timbang BB</label>
                                        <div class="input-group">
                                            <input type="number" name="berat_badan1" class="form-control" step="any">
                                            <span class="input-group-text">Kg</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Pengukuran Tinggi Badan</label>
                                        <div class="input-group">
                                            <input type="number" name="tinggi_badan1" step="any" class="form-control">
                                            <span class="input-group-text">Cm</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Ukur Lingkar Lengan Atas</label>
                                        <input type="number" name="lingkar_lengan1" step="any" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tekanan Darah</label>
                                        <div class="input-group">
                                            <input type="number" name="sistolik" class="form-control"
                                                placeholder="Sistolik" step="any" min="0">
                                            <span class="input-group-text">/Sistol</span>
                                            <input type="number" name="diastolik" class="form-control"
                                                placeholder="Diastolik" step="any" min="0">
                                            <span class="input-group-text">/Diastol</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Periksa Tinggi Rahim</label>
                                        <input type="text" name="tinggi_rahim1" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Letak dan Denyut Jantung Janin</label>
                                        <input type="text" name="denyut_janin1" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Status dan Imunisasi Tetanus</label>
                                        <select name="imunisasi_tetanus1" class="form-control">
                                            <option value="">-- Pilih Status Imunisasi --</option>
                                            <option value="T1">T1</option>
                                            <option value="T2">T2</option>
                                            <option value="T3">T3</option>
                                            <option value="T4">T4</option>
                                            <option value="T5">T5</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Konseling</label>
                                        <input type="text" name="konseling1" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Skrining Dokter</label>
                                        <input type="text" name="skrining_dokter1" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tablet Tambah Darah</label>
                                        <input type="text" name="tambah_darah1" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tes Golongan Darah</label>
                                        <select name="gol_darah1" class="form-control">
                                            <option value="">-- Pilih Golongan Darah --</option>
                                            <option value="A-">A-</option>
                                            <option value="A+">A+</option>
                                            <option value="B-">B-</option>
                                            <option value="B+">B+</option>
                                            <option value="AB-">AB-</option>
                                            <option value="AB+">AB+</option>
                                            <option value="O-">O-</option>
                                            <option value="O+">O+</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="step-section d-none step-2" id="">
                                <div class="row g-3">
                                    <h5>Riwayat Kesehatan Ibu Sekarang</h5>
                                    <div class="col-md-12 mb-4">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan_ibu[]" value="Alergi" id="ibu_alergi">
                                                    <label class="form-check-label" for="ibu_alergi">Alergi</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan_ibu[]" value="Asma" id="ibu_asma">
                                                    <label class="form-check-label" for="ibu_asma">Asma</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan_ibu[]" value="Autoimun"
                                                        id="ibu_autoimun">
                                                    <label class="form-check-label" for="ibu_autoimun">Autoimun</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan_ibu[]" value="Diabetes"
                                                        id="ibu_diabetes">
                                                    <label class="form-check-label" for="ibu_diabetes">Diabetes</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan_ibu[]" value="Hepatitis B"
                                                        id="ibu_hepatitisB">
                                                    <label class="form-check-label" for="ibu_hepatitisB">Hepatitis
                                                        B</label>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan_ibu[]" value="Hipertensi"
                                                        id="ibu_hipertensi">
                                                    <label class="form-check-label"
                                                        for="ibu_hipertensi">Hipertensi</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan_ibu[]" value="Jantung" id="ibu_jantung">
                                                    <label class="form-check-label" for="ibu_jantung">Jantung</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan_ibu[]" value="Jiwa" id="ibu_jiwa">
                                                    <label class="form-check-label" for="ibu_jiwa">Jiwa</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan_ibu[]" value="Sifilis" id="ibu_sifilis">
                                                    <label class="form-check-label" for="ibu_sifilis">Sifilis</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan_ibu[]" value="TB" id="ibu_tb">
                                                    <label class="form-check-label" for="ibu_tb">TB</label>
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
                                                        name="riwayat_kesehatan_keluarga[]" value="Alergi"
                                                        id="keluarga_alergi">
                                                    <label class="form-check-label" for="keluarga_alergi">Alergi</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan_keluarga[]" value="Asma"
                                                        id="keluarga_asma">
                                                    <label class="form-check-label" for="keluarga_asma">Asma</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan_keluarga[]" value="Autoimun"
                                                        id="keluarga_autoimun">
                                                    <label class="form-check-label"
                                                        for="keluarga_autoimun">Autoimun</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan_keluarga[]" value="Diabetes"
                                                        id="keluarga_diabetes">
                                                    <label class="form-check-label"
                                                        for="keluarga_diabetes">Diabetes</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan_keluarga[]" value="Hepatitis B"
                                                        id="keluarga_hepatitisB">
                                                    <label class="form-check-label" for="keluarga_hepatitisB">Hepatitis
                                                        B</label>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan_keluarga[]" value="Hipertensi"
                                                        id="keluarga_hipertensi">
                                                    <label class="form-check-label"
                                                        for="keluarga_hipertensi">Hipertensi</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan_keluarga[]" value="Jantung"
                                                        id="keluarga_jantung">
                                                    <label class="form-check-label" for="keluarga_jantung">Jantung</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan_keluarga[]" value="Jiwa"
                                                        id="keluarga_jiwa">
                                                    <label class="form-check-label" for="keluarga_jiwa">Jiwa</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan_keluarga[]" value="Sifilis"
                                                        id="keluarga_sifilis">
                                                    <label class="form-check-label" for="keluarga_sifilis">Sifilis</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="riwayat_kesehatan_keluarga[]" value="TB"
                                                        id="keluarga_tb">
                                                    <label class="form-check-label" for="keluarga_tb">TB</label>
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
                                                    <td><input type="number" name="tahun1"
                                                            class="form-control form-control-sm"></td>
                                                    <td><input type="number" step="any" name="bb1"
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
                            <div class="step-section d-none step-3" id="">
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
                                                    <td><input type="radio" name="konjungtiva1" value="anemia"></td>
                                                    <td><input type="radio" name="konjungtiva1" value="tidak_anemia">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Sklera</td>
                                                    <td><input type="radio" name="sklera1" value="ikterik"></td>
                                                    <td><input type="radio" name="sklera1" value="tidak_ikterik"></td>
                                                </tr>
                                                <tr>
                                                    <td>Kulit</td>
                                                    <td><input type="radio" name="kulit1" value="normal"></td>
                                                    <td><input type="radio" name="kulit1" value="tidak_normal"></td>
                                                </tr>
                                                <tr>
                                                    <td>Leher</td>
                                                    <td><input type="radio" name="leher1" value="normal"></td>
                                                    <td><input type="radio" name="leher1" value="tidak_normal"></td>
                                                </tr>
                                                <tr>
                                                    <td>Gigi Mulut </td>
                                                    <td><input type="radio" name="gigi_mulut1" value="normal"></td>
                                                    <td><input type="radio" name="gigi_mulut1" value="tidak_normal">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>THT</td>
                                                    <td><input type="radio" name="tht1" value="normal"></td>
                                                    <td><input type="radio" name="tht1" value="tidak_normal"></td>
                                                </tr>
                                                <tr>
                                                    <td>Dada</td>
                                                    <td><input type="radio" name="dada1" value="normal"></td>
                                                    <td><input type="radio" name="dada1" value="tidak_normal"></td>
                                                </tr>
                                                <tr>
                                                    <td>Jantung</td>
                                                    <td><input type="radio" name="jantung1" value="normal"></td>
                                                    <td><input type="radio" name="jantung1" value="tidak_normal"></td>
                                                </tr>
                                                <tr>
                                                    <td>Paru</td>
                                                    <td><input type="radio" name="paru1" value="normal"></td>
                                                    <td><input type="radio" name="paru1" value="tidak_normal"></td>
                                                </tr>
                                                <tr>
                                                    <td>Perut</td>
                                                    <td><input type="radio" name="perut1" value="normal"></td>
                                                    <td><input type="radio" name="perut1" value="tidak_normal"></td>
                                                </tr>
                                                <tr>
                                                    <td>Tungkai</td>
                                                    <td><input type="radio" name="tungkai1" value="normal"></td>
                                                    <td><input type="radio" name="tungkai1" value="tidak_normal"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <h5>USG Trimester 1</h5>
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
                                        <input type="number" id="umur_kehamilan_hpht" name="umur_kehamilan_hpht"
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
                                        <input type="number" id="umur_kehamilan_usg" name="umur_kehamilan_usg"
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
                                    <div class="table-responsive">
                                        <table class="table table-bordered align-middle text-start">
                                            <tbody>
                                                <tr>
                                                    <td class="table-dark text-white">Jumlah GS</td>
                                                    <td>
                                                        <select name="jumlah_gs" class="form-select">
                                                            <option value="tunggal">Tunggal</option>
                                                            <option value="kembar">Kembar</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="table-dark text-white">Diameter GS</td>
                                                    <td>
                                                        <input type="number" step="any" name="diameter_gs"
                                                            class="form-control mb-2" placeholder="... cm">
                                                        <span class="d-block mb-1">Sesuai dengan umur kehamilan:</span>
                                                        <div class="input-group mb-1">
                                                            <input type="number" name="gs_minggu" class="form-control"
                                                                placeholder="... minggu">
                                                            <span class="input-group-text">Minggu</span>
                                                            <input type="number" name="gs_hari" class="form-control"
                                                                placeholder="... hari">
                                                            <span class="input-group-text">Hari</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="table-dark text-white">Jumlah Bayi</td>
                                                    <td>
                                                        <select name="jumlah_bayi" class="form-select">
                                                            <option value="tunggal">Tunggal</option>
                                                            <option value="kembar">Kembar</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="table-dark text-white">CRL</td>
                                                    <td>
                                                        <input type="number" name="crl" class="form-control mb-2"
                                                            placeholder="... cm">
                                                        <span class="d-block mb-1">Sesuai dengan umur kehamilan:</span>
                                                        <div class="input-group mb-1">
                                                            <input type="number" name="crl_minggu" class="form-control"
                                                                placeholder="... minggu">
                                                            <span class="input-group-text">Minggu</span>
                                                            <input type="number" name="crl_hari" class="form-control"
                                                                placeholder="... hari">
                                                            <span class="input-group-text">Hari</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="table-dark text-white">Letak Produk Kehamilan</td>
                                                    <td>
                                                        <select name="letak_produk" class="form-select">
                                                            <option value="intrauterin">Intrauterin</option>
                                                            <option value="extrauterin">Extrauterin</option>
                                                            <option value="tidak_dapat_ditentukan">Tidak dapat ditentukan
                                                            </option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="table-dark text-white">Pulsasi Jantung</td>
                                                    <td>
                                                        <select name="pulsasi_jantung" class="form-select">
                                                            <option value="tampak">Tampak</option>
                                                            <option value="tidak_tampak">Tidak tampak</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="table-dark text-white">Kecurigaan Temuan Abnormal</td>
                                                    <td>
                                                        <select name="kecurigaan_temuan" class="form-select mb-2">
                                                            <option value="ya">Ya</option>
                                                            <option value="tidak">Tidak</option>
                                                        </select>
                                                        <input type="text" name="alasan" class="form-control"
                                                            placeholder="Sebutkan jika ada...">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <div class="step-section d-none step-4" id="">
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
                                                            <input type="number" name="hemoglobin1" class="form-control"
                                                                step="any" placeholder="Nilai">
                                                            <span class="input-group-text">g/dL</span>
                                                        </div>
                                                    </td>
                                                    <td><input type="text" name="hemoglobin1_rtl"
                                                            class="form-control form-control-sm"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-start">Golongan Darah & Rhesus</td>
                                                    <td><input type="text" name="golDarah_rhesus"
                                                            class="form-control form-control-sm"></td>
                                                    <td><input type="text" name="rhesus_rtl"
                                                            class="form-control form-control-sm"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-start">Gula Darah Sewaktu</td>
                                                    <td>
                                                        <div class="input-group input-group-sm">
                                                            <input type="number" name="gulaDarah1" step="any"
                                                                class="form-control" placeholder="Nilai">
                                                            <span class="input-group-text">Mg/dL</span>
                                                        </div>
                                                    </td>
                                                    <td><input type="text" name="gulaDarah1_rtl"
                                                            class="form-control form-control-sm"></td>
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
                                                                    name="skrining_jiwa_tr1" value="ya"
                                                                    id="skrining_ya_tr1">
                                                                <label class="form-check-label"
                                                                    for="skrining_ya_tr1">Ya</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="skrining_jiwa_tr1" value="tidak"
                                                                    id="skrining_tidak_tr1">
                                                                <label class="form-check-label"
                                                                    for="skrining_tidak_tr1">Tidak</label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-start">Tindak Lanjut Hasil Skrining Kesehatan Jiwa
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="tindak_lanjut_tr1" value="edukasi"
                                                                    id="edukasi_tr1">
                                                                <label class="form-check-label"
                                                                    for="edukasi_tr1">Edukasi</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="tindak_lanjut_tr1" value="konseling"
                                                                    id="konseling_tr1">
                                                                <label class="form-check-label"
                                                                    for="konseling_tr1">Konseling</label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-start">Perlu Rujukan</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="rujukan_tr1" value="ya"
                                                                    id="rujukan_ya_tr1">
                                                                <label class="form-check-label"
                                                                    for="rujukan_ya_tr1">Ya</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="rujukan_tr1" value="tidak"
                                                                    id="rujukan_tidak_tr1">
                                                                <label class="form-check-label"
                                                                    for="rujukan_tidak_tr1">Tidak</label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="form-trimester-2" class="form-section d-none">
                            <div class="step-section step-1" id="">
                                <div class="row g-3">
                                    <h5>Catatan Pemeriksaan</h5>
                                    <div class="col-md-6">
                                        <label class="form-label">Tanggal Periksa</label>
                                        <input type="date" name="tanggal_periksa2" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tempat Periksa</label>
                                        <input type="text" name="tempat_periksa2" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Timbang BB</label>
                                        <div class="input-group">
                                            <input type="number" step="any" name="berat_badan2"
                                                class="form-control">
                                            <span class="input-group-text">Kg</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Ukur Lingkar Lengan Atas</label>
                                        <input type="number" step="any" name="lingkar_lengan2"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tekanan Darah</label>
                                        <div class="input-group">
                                            <input type="number" name="sistolik2" class="form-control"
                                                placeholder="Sistolik" step="any" min="0">
                                            <span class="input-group-text">/Sistol</span>
                                            <input type="number" name="diastolik2" class="form-control"
                                                placeholder="Diastolik" step="any" min="0">
                                            <span class="input-group-text">/Diastol</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Periksa Tinggi Rahim</label>
                                        <input type="text" name="tinggi_rahim2" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Letak dan Denyut Jantung Janin</label>
                                        <input type="text" name="denyut_janin2" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Konseling</label>
                                        <input type="text" name="konseling2" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Skrining Dokter</label>
                                        <input type="text" name="skrining_dokter2" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tablet Tambah Darah</label>
                                        <input type="text" name="tambah_darah2" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tes Lab Protein Urine</label>
                                        <input type="text" name="urine2" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="form-trimester-3" class="form-section d-none">
                            <div class="step-section step-1" id="">
                                <div class="row g-3">
                                    <h5>Catatan Pemeriksaan</h5>
                                    <div class="col-md-6">
                                        <label class="form-label">Tanggal Periksa</label>
                                        <input type="date" name="tanggal_periksa3" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tempat Periksa</label>
                                        <input type="text" name="tempat_periksa3" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Timbang BB</label>
                                        <div class="input-group">
                                            <input type="number" step="any" name="berat_badan3"
                                                class="form-control">
                                            <span class="input-group-text">Kg</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Ukur Lingkar Lengan Atas</label>
                                        <input type="number" step="any" name="lingkar_lengan3"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tekanan Darah</label>
                                        <div class="input-group">
                                            <input type="number" name="sistolik3" class="form-control"
                                                placeholder="Sistolik" step="any" min="0">
                                            <span class="input-group-text">/Sistol</span>
                                            <input type="number" name="diastolik3" class="form-control"
                                                placeholder="Diastolik" step="any" min="0">
                                            <span class="input-group-text">/Diastol</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Periksa Tinggi Rahim</label>
                                        <input type="text" name="tinggi_rahim3" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Letak dan Denyut Jantung Janin</label>
                                        <input type="text" name="denyut_janin3" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Konseling</label>
                                        <input type="text" name="konseling3" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Skrining Dokter</label>
                                        <input type="text" name="skrining_dokter3" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tablet Tambah Darah</label>
                                        <input type="text" name="tambah_darah3" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tes Lab Protein Urine</label>
                                        <input type="text" name="urine3" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tes Lab Gula Darah</label>
                                        <input type="text" name="gula_darah3" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="step-section step-2">
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
                                                    <td><input type="radio" name="konjungtiva3" value="anemia"></td>
                                                    <td><input type="radio" name="konjungtiva3" value="tidak_anemia">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Sklera</td>
                                                    <td><input type="radio" name="sklera3" value="ikterik"></td>
                                                    <td><input type="radio" name="sklera3" value="tidak_ikterik">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Kulit</td>
                                                    <td><input type="radio" name="kulit3" value="normal"></td>
                                                    <td><input type="radio" name="kulit3" value="tidak_normal">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Leher</td>
                                                    <td><input type="radio" name="leher3" value="normal"></td>
                                                    <td><input type="radio" name="leher3" value="tidak_normal">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Gigi Mulut </td>
                                                    <td><input type="radio" name="gigi_mulut3" value="normal"></td>
                                                    <td><input type="radio" name="gigi_mulut3" value="tidak_normal">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>THT</td>
                                                    <td><input type="radio" name="tht3" value="normal"></td>
                                                    <td><input type="radio" name="tht3" value="tidak_normal">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Dada</td>
                                                    <td><input type="radio" name="dada3" value="normal"></td>
                                                    <td><input type="radio" name="dada3" value="tidak_normal">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Jantung</td>
                                                    <td><input type="radio" name="jantung3" value="normal"></td>
                                                    <td><input type="radio" name="jantung3" value="tidak_normal">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Paru</td>
                                                    <td><input type="radio" name="paru3" value="normal"></td>
                                                    <td><input type="radio" name="paru3" value="tidak_normal">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Perut</td>
                                                    <td><input type="radio" name="perut3" value="normal"></td>
                                                    <td><input type="radio" name="perut3" value="tidak_normal">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Tungkai</td>
                                                    <td><input type="radio" name="tungkai3" value="normal"></td>
                                                    <td><input type="radio" name="tungkai3" value="tidak_normal">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <h5>USG Trimester III</h5>
                                    <div style="margin-bottom: 12px;">
                                        <label>USG Trimester III telah dilakukan:</label><br>
                                        <select name="usg_tr3" class="form-select">
                                            <option value="ya">Ya</option>
                                            <option value="tidak">Tidak</option>
                                        </select>
                                    </div>

                                    <div style="margin-bottom: 12px;">
                                        <label>Umur Kehamilan berdasarkan USG Trimester I:</label>
                                        <input type="number" name="umur_kehamilan_usg3" class="form-control"
                                            placeholder="... minggu">
                                    </div>

                                    <div style="margin-bottom: 12px;">
                                        <label>Umur Kehamilan berdasarkan HPHT:</label>
                                        <input type="number" name="umur_kehamilan_hpht3" class="form-control"
                                            placeholder="... minggu">
                                    </div>

                                    <div style="margin-bottom: 12px;">
                                        <label>Umur Kehamilan berdasarkan biometrik bayi USG Trimester III:</label>
                                        <input type="number" name="umur_kehamilan_biometrik3" class="form-control"
                                            placeholder="... minggu">
                                    </div>

                                    <div style="margin-bottom: 12px;">
                                        <label>Apakah terdapat selisih 3 minggu atau lebih dengan UK USG Trimester
                                            I/HPHT:</label>
                                        <select name="selisih_3_minggu" class="form-select">
                                            <option value="ya">Ya</option>
                                            <option value="tidak">Tidak</option>
                                        </select>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-bordered align-middle text-start">
                                            <tbody>
                                                <tr>
                                                    <td class="table-dark text-white">Jumlah bayi</td>
                                                    <td>
                                                        <select name="jumlah_bayi3" class="form-select">
                                                            <option value="tunggal">Tunggal</option>
                                                            <option value="kembar">Kembar</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="table-dark text-white">Letak bayi</td>
                                                    <td>
                                                        <select name="letak3" class="form-select">
                                                            <option value="intrauterin">Intrauterin</option>
                                                            <option value="extrauterin">Extrauterin</option>
                                                            <option value="tidak_dapat_ditentukan">Tidak dapat ditentukan
                                                            </option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="table-dark text-white">Presentasi bayi</td>
                                                    <td>
                                                        <select name="presentasi3" class="form-select">
                                                            <option value="kepala">Kepala</option>
                                                            <option value="bokong">Bokong</option>
                                                            <option value="letak_lintang">Letak Lintang</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="table-dark text-white">Keadaan bayi</td>
                                                    <td>
                                                        <div class="mb-2">
                                                            <label class="form-label mb-1">Status:</label>
                                                            <select name="keadaan3" class="form-select">
                                                                <option value="hidup">Hidup</option>
                                                                <option value="meninggal">Meninggal</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-2 d-flex align-items-center">
                                                            <label class="form-label mb-0 me-2">DJJ:</label>
                                                            <input type="number" name="djj3"
                                                                class="form-control me-2" style="width: 150px;"
                                                                placeholder="... X/menit">
                                                            <select name="djj_status3" class="form-select">
                                                                <option value="normal">Normal</option>
                                                                <option value="tidak_normal">Tidak normal</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="table-dark text-white">Lokasi Plasenta</td>
                                                    <td>
                                                        <select name="lokasi_plasenta3" class="form-select">
                                                            <option value="fundus">Fundus</option>
                                                            <option value="corpus">Corpus</option>
                                                            <option value="letak_rendah">Letak rendah</option>
                                                            <option value="previa">Previa</option>
                                                        </select>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="table-dark text-white">Jumlah Cairan Ketuban</td>
                                                    <td>
                                                        <div class="mb-2 d-flex align-items-center">
                                                            <label class="form-label mb-0 me-2">SDP:</label>
                                                            <input type="number" name="sdp3" step="any"
                                                                class="form-control me-2" style="width: 150px;"
                                                                placeholder="... cm">
                                                            <select name="jumlah_ketuban3" class="form-select">
                                                                <option value="cukup">Cukup</option>
                                                                <option value="kurang">Kurang</option>
                                                                <option value="berlebih">Berlebih</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="table-dark text-white">Biometri bayi</td>
                                                    <td>
                                                        <div class="container-fluid">
                                                            <div class="row mb-2 align-items-center">
                                                                <div class="col-md-1 fw-bold">BPD:</div>
                                                                <div class="col-md-2">
                                                                    <input type="number" name="bpd3"
                                                                        step="any" class="form-control"
                                                                        placeholder="... cm">
                                                                </div>
                                                                <div class="col-md-2 text-md-end">Sesuai:</div>
                                                                <div class="col-md-2">
                                                                    <input type="number" name="bpd_minggu3"
                                                                        class="form-control" placeholder="... minggu">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2 align-items-center">
                                                                <div class="col-md-1 fw-bold">HC:</div>
                                                                <div class="col-md-2">
                                                                    <input type="number" name="hc3"
                                                                        step="any" class="form-control"
                                                                        placeholder="... cm">
                                                                </div>
                                                                <div class="col-md-2 text-md-end">Sesuai:</div>
                                                                <div class="col-md-2">
                                                                    <input type="number" name="hc_minggu3"
                                                                        class="form-control" placeholder="... minggu">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2 align-items-center">
                                                                <div class="col-md-1 fw-bold">AC:</div>
                                                                <div class="col-md-2">
                                                                    <input type="number" name="ac3"
                                                                        step="any" class="form-control"
                                                                        placeholder="... cm">
                                                                </div>
                                                                <div class="col-md-2 text-md-end">Sesuai:</div>
                                                                <div class="col-md-2">
                                                                    <input type="number" name="ac_minggu3"
                                                                        class="form-control" placeholder="... minggu">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2 align-items-center">
                                                                <div class="col-md-1 fw-bold">FL:</div>
                                                                <div class="col-md-2">
                                                                    <input type="number" name="fl3"
                                                                        step="any" class="form-control"
                                                                        placeholder="... cm">
                                                                </div>
                                                                <div class="col-md-2 text-md-end">Sesuai:</div>
                                                                <div class="col-md-2">
                                                                    <input type="number" name="fl_minggu3"
                                                                        class="form-control" placeholder="... minggu">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2 align-items-center">
                                                                <div class="col-md-1 fw-bold">EFW/TBJ:</div>
                                                                <div class="col-md-2">
                                                                    <input type="number" name="efw3"
                                                                        step="any" class="form-control"
                                                                        placeholder="... gram">
                                                                </div>
                                                                <div class="col-md-2 text-md-end">Sesuai:</div>
                                                                <div class="col-md-2">
                                                                    <input type="number" name="efw_minggu3"
                                                                        class="form-control" placeholder="... minggu">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="table-dark text-white">Kecurigaan Temuan Abnormal</td>
                                                    <td>
                                                        <select name="kecurigaan3" class="form-select mb-2">
                                                            <option value="ya">Ya</option>
                                                            <option value="tidak">Tidak</option>
                                                        </select>
                                                        <input type="text" name="alasan3" class="form-control"
                                                            placeholder="Sebutkan jika ada...">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="step-section step-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h5 class="mb-0">Pemeriksaan Laboratorium</h5>
                                    <div class="d-flex align-items-center">
                                        <label class="me-2 mb-0">Tanggal:</label>
                                        <input type="text" class="form-control form-control-sm"
                                            style="width: 150px;">
                                    </div>
                                </div>
                                <div class="row g-3 mb-2">
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
                                                            <input type="number" name="hemoglobin3"
                                                                class="form-control" step="any"
                                                                placeholder="Nilai">
                                                            <span class="input-group-text">g/dL</span>
                                                        </div>
                                                    </td>
                                                    <td><input type="text" name="hemoglobin_rtl3"
                                                            class="form-control form-control-sm"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-start">Protein Urine</td>
                                                    <td>
                                                        <div class="input-group input-group-sm">
                                                            <input type="number" name="protein_urin3" step="any"
                                                                class="form-control" placeholder="Nilai">
                                                            <span class="input-group-text">Mg/dL</span>
                                                        </div>
                                                    </td>
                                                    <td><input type="text" name="protein_urin_rtl3"
                                                            class="form-control form-control-sm"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-start">Urine Reduksi</td>
                                                    <td>
                                                        <div class="d-flex justify-content-start gap-2">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="urine_reduksi" id="negatif"
                                                                    value="negatif">
                                                                <label class="form-check-label"
                                                                    for="negatif">Negatif</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="urine_reduksi" id="plus1"
                                                                    value="+1">
                                                                <label class="form-check-label"
                                                                    for="plus1">+1</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="urine_reduksi" id="plus2"
                                                                    value="+2">
                                                                <label class="form-check-label"
                                                                    for="plus2">+2</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="urine_reduksi" id="plus3"
                                                                    value="+3">
                                                                <label class="form-check-label"
                                                                    for="plus3">+3</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="urine_reduksi" id="plus4"
                                                                    value="+4">
                                                                <label class="form-check-label"
                                                                    for="plus4">+4</label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><input type="text" name="urin_reduksi_rtl3"
                                                            class="form-control form-control-sm"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
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
                                                                name="skrining_jiwa_tr3" value="ya"
                                                                id="skrining_ya_tr3">
                                                            <label class="form-check-label"
                                                                for="skrining_ya_tr3">Ya</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="skrining_jiwa_tr3" value="tidak"
                                                                id="skrining_tidak_tr3">
                                                            <label class="form-check-label"
                                                                for="skrining_tidak_tr3">Tidak</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-start">Tindak Lanjut Hasil Skrining Kesehatan Jiwa
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="tindak_lanjut_tr3" value="edukasi"
                                                                id="edukasi_tr3">
                                                            <label class="form-check-label"
                                                                for="edukasi_tr3">Edukasi</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="tindak_lanjut_tr3" value="konseling"
                                                                id="konseling_tr3">
                                                            <label class="form-check-label"
                                                                for="konseling_tr3">Konseling</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-start">Perlu Rujukan</td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="rujukan_tr3" value="ya" id="rujukan_ya_tr3">
                                                            <label class="form-check-label"
                                                                for="rujukan_ya_tr3">Ya</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="rujukan_tr3" value="tidak"
                                                                id="rujukan_tidak_tr3">
                                                            <label class="form-check-label"
                                                                for="rujukan_tidak_tr3">Tidak</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row g-3 mt-4">
                                    <h5>Rencana Konsultasi Lanjut</h5>
                                    <div class="col-md-12 mb-4">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="rencana_konsultasi[]" value="Gizi" id="gizi">
                                                    <label class="form-check-label" for="gizi">Gizi</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="rencana_konsultasi[]" value="Kebidanan" id="kebidanan">
                                                    <label class="form-check-label" for="kebidanan">Kebidanan</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="rencana_konsultasi[]" value="Anak" id="anak">
                                                    <label class="form-check-label" for="anak">Anak</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="rencana_konsultasi[]" value="Penyakit_Dalam"
                                                        id="penyakit_dalam">
                                                    <label class="form-check-label" for="penyakit_dalam">Penyakit
                                                        Dalam</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="rencana_konsultasi[]" value="Neurologi" id="neurologi">
                                                    <label class="form-check-label" for="neurologi">Neurologi</label>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="rencana_konsultasi[]" value="THT" id="tht">
                                                    <label class="form-check-label" for="tht">THT</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="rencana_konsultasi[]" value="Psikiatri" id="psikiatri">
                                                    <label class="form-check-label" for="psikiatri">Psikiatri</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="rencana_konsultasi[]" value="lainnya" id="lainnya">
                                                    <label class="form-check-label" for="lainnya">Lain-lain</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 mt-4">
                                    <h5>Rencana Proses Melahirkan</h5>
                                    <div class="col-md-12 mb-4">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="rencana_melahirkan" id="normal" value="normal">
                                                    <label class="form-check-label" for="normal">Normal</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="rencana_melahirkan" id="pervaginam"
                                                        value="pervaginam_berbantu">
                                                    <label class="form-check-label" for="pervaginam">Pervaginam
                                                        Berbantu</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="rencana_melahirkan" id="sectio"
                                                        value="sectio_caesaria">
                                                    <label class="form-check-label" for="sectio">Sectio
                                                        Caesaria</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 mt-4">
                                    <h5>Pilihan Rencana Kontrasepsi</h5>
                                    <div class="col-md-12 mb-4">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="kontrasepsi"
                                                        id="akdr" value="AKDR">
                                                    <label class="form-check-label" for="akdr">AKDR</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="kontrasepsi"
                                                        id="pil" value="Pil">
                                                    <label class="form-check-label" for="pil">Pil</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="kontrasepsi"
                                                        id="suntik" value="Suntik">
                                                    <label class="form-check-label" for="suntik">Suntik</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="kontrasepsi"
                                                        id="steril" value="Steril">
                                                    <label class="form-check-label" for="steril">Steril</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="kontrasepsi"
                                                        id="mal" value="MAL">
                                                    <label class="form-check-label" for="mal">MAL</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="kontrasepsi"
                                                        id="implan" value="Implan">
                                                    <label class="form-check-label" for="implan">Implan</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="kontrasepsi"
                                                        id="belum_memilih" value="belum_memilih">
                                                    <label class="form-check-label" for="belum_memilih">Belum
                                                        memilih</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 mt-4">
                                    <h5>Kebutuhan Konseling</h5>
                                    <div class="col-md-12">
                                        <div class="d-flex gap-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    name="kebutuhan_konseling" id="konseling_ya" value="ya">
                                                <label class="form-check-label" for="konseling_ya">Ya</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    name="kebutuhan_konseling" id="konseling_tidak" value="tidak">
                                                <label class="form-check-label" for="konseling_tidak">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <button type="button" class="btn btn-danger" id="btnKembali"
                                style="display:none;">Kembali</button>
                            <button type="button" class="btn btn-primary" id="btnLanjutkan" name="trimester"
                                value="1">Lanjutkan</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </section>
    <script>
        let currentForm = '#form-trimester-1';

        function showForm(formId, trimesterActive) {
            currentForm = '#' + formId;
            // Sembunyikan semua form
            document.querySelectorAll('.form-section').forEach(function(section) {
                section.classList.add('d-none');
            });
            document.getElementById(formId).classList.remove('d-none');
            document.querySelectorAll('.btn-toggle-form').forEach(function(btn) {
                btn.classList.remove('active');
            });
            document.getElementById('btnLanjutkan').value = trimesterActive;
            event.target.classList.add('active');
            currentStep = 1
            showStep(currentStep);
        }
    </script>
    <script>
        let currentStep = 1;
        let totalSteps = document.querySelectorAll('#form-trimester-1 .step-section').length;
        const btnLanjutkan = document.getElementById('btnLanjutkan');
        const btnKembali = document.getElementById('btnKembali');

        function showStep(step) {
            totalSteps = document.querySelectorAll(`${currentForm} .step-section`).length;
            document.querySelectorAll(`${currentForm} .step-section`).forEach(section => {
                section.classList.add('d-none');
            });
            document.querySelector(`${currentForm} .step-${step}`).classList.remove('d-none');

            if (step === 1) {
                btnKembali.style.display = 'none';
            } else {
                btnKembali.style.display = 'inline-block';
            }
            console.log(step, totalSteps);

            if (step === totalSteps) {
                btnLanjutkan.textContent = 'Simpan';
                btnLanjutkan.type = 'submit';
            } else {
                btnLanjutkan.textContent = 'Lanjutkan';
                btnLanjutkan.type = 'button';
            }
        }

        btnLanjutkan.addEventListener('click', function(e) {
            if (currentStep < totalSteps) {
                e.preventDefault();
                currentStep++;
                showStep(currentStep);
            } else {
                const anggotaId = document.getElementById('anggota-id').value;

                if (!anggotaId) {
                    e.preventDefault();
                    alert('Silakan pilih anggota terlebih dahulu sebelum menyimpan.');
                    return;
                }
            }
        });

        btnKembali.addEventListener('click', function() {
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
            }
        });
        showStep(currentStep);
    </script>
    <script>
        const input = document.getElementById('input-anggota');
        const suggestionBox = document.getElementById('suggestion-box');
        const anggotaIdInput = document.getElementById('anggota-id');

        input.addEventListener('keyup', function() {
            const query = this.value;

            if (query.length < 2) {
                suggestionBox.innerHTML = '';
                return;
            }

            fetch(`/anggota/saran?q=${query}`)
                .then(res => res.json())
                .then(data => {
                    suggestionBox.innerHTML = '';

                    if (data.length === 0) {
                        suggestionBox.innerHTML = '<div class="p-2 text-muted">Tidak ditemukan</div>';
                        return;
                    }

                    data.forEach(item => {
                        console.log(data);
                        const div = document.createElement('div');
                        div.textContent = item.nama;
                        div.classList.add('p-2', 'suggestion-item', 'border-bottom', 'cursor-pointer');
                        div.dataset.id = item.id;

                        div.addEventListener('click', function() {
                            input.value = this.textContent;
                            anggotaIdInput.value = this.dataset.id;
                            suggestionBox.innerHTML = '';
                        });

                        suggestionBox.appendChild(div);
                    });
                });
        });

        document.addEventListener('click', function(e) {
            if (!input.contains(e.target) && !suggestionBox.contains(e.target)) {
                suggestionBox.innerHTML = '';
            }
        });
    </script>
@endsection
