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

                <div class="card card-body border">
                    <div class="d-flex gap-2 mb-4">
                        <button type="button" class="btn btn-outline-primary btn-toggle-form active"
                            onclick="showForm('form-trimester-1')">Trimester 1</button>
                        <button type="button" class="btn btn-outline-primary btn-toggle-form"
                            onclick="showForm('form-trimester-3')">Trimester 3</button>
                        <button class="btn btn-outline-primary">Pemeriksaan Lab Kehamilan</button>
                        <button class="btn btn-outline-primary">Pemeriksaan Kehamilan</button>
                    </div>

                    <div id="form-trimester-1" class="form-section">
                        <form action="#" method="post">
                            @csrf
                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label class="form-label">Tanggal Periksa</label>
                                    <input type="date" name="tanggal_periksa" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Anggota</label>
                                    <div class="input-group">
                                        <input type="text" name="anggota" class="form-control"
                                            placeholder="Nama Anggota">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Tempat Periksa</label>
                                    <input type="text" name="tempat_periksa" class="form-control">
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
                                    <label class="form-label">Test Lab Hemoglobin</label>
                                    <input type="text" name="hb" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Test Golongan Darah</label>
                                    <input type="text" name="tes_gol_darah" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Test Lab Gula Darah</label>
                                    <input type="text" name="gula_darah" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">PPIA</label>
                                    <input type="text" name="ppia" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Tata Laksana Kasus</label>
                                    <input type="text" name="laksana_kasus" class="form-control">
                                </div>

                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <a href="{{ route('dashboard') }}" class="btn btn-danger">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
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

                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <a href="{{ route('dashboard') }}" class="btn btn-danger">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
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
@endsection
