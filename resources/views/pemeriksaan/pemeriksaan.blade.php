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
                        onclick="showForm('form-trimester-3')">Trimester 2</button>
                    <button class="btn btn-outline-primary">Trimester 3</button>
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
                        <form action="#" method="post" id="formTrimester1">
                            @csrf
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
                                        <label class="form-label">Tes Lab Hemoglobin</label>
                                        <input type="text" name="tes_hb" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tes Golongan Darah</label>
                                        <input type="text" name="gol_darah" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">USG</label>
                                        <input type="text" name="usg" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tripel Eliminasi (H / S / Hep B)</label>
                                        <div class="row g-2">
                                            <div class="col">
                                                <input type="text" name="tripel_h" class="form-control"
                                                    placeholder="H">
                                            </div>
                                            <div class="col">
                                                <input type="text" name="tripel_s" class="form-control"
                                                    placeholder="S">
                                            </div>
                                            <div class="col">
                                                <input type="text" name="tripel_hepb" class="form-control"
                                                    placeholder="Hep B">
                                            </div>
                                        </div>
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
                                </div>
                                <div class="row g-3 mt-4">
                                    <h5>Pemeriksaan Khusus</h5>
                                </div>
                                <div class="row g-3 mt-4">
                                    <h5>Riwayat Kehamilan dan Proses Melahirkan</h5>
                                </div>
                            </div>
                            <div class="step-section d-none" id="step-3">

                            </div>
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
        <div id="form-trimester-3" class="form-section d-none">
            <form action="#" method="post">
                @csrf
                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Tanggal Periksa (Trimester 3)</label>
                        <input type="date" name="tanggal_periksa_3" class="form-control">
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
        }
    </script>
    <script>
        let currentStep = 1;
        const totalSteps = document.querySelectorAll('#formTrimester1 .step-section').length;

        const btnLanjutkan = document.getElementById('btnLanjutkan');
        const btnKembali = document.getElementById('btnKembali');

        function showStep(step) {
            // Sembunyikan semua step
            document.querySelectorAll('#formTrimester1 .step-section').forEach(section => {
                section.classList.add('d-none');
            });
            document.getElementById('step-' + step).classList.remove('d-none');

            if (step === 1) {
                btnKembali.style.display = 'none';
            } else {
                btnKembali.style.display = 'inline-block';
            }

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
