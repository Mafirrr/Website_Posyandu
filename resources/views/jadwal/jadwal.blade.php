@extends('layouts.app')

@section('main')
    <div class="container mt-4">
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="fw-semibold mb-8">Pelayanan Posyandu</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted text-decoration-none" href="#">Pelayanan Posyandu</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Jadwal Posyandu</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border mb-4">
            <div class="card-body">
                <h4 class="card-title mb-4">Daftar Jadwal</h4>
                <div class="table-responsive">
                    <table class="table search-table align-middle text-nowrap">
                        <thead class="header-item">
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Lokasi</th>
                                <th>Kategori</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Pembuatan Jadwal</h4>

                <form action="{{ route('jadwal') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="lokasi" class="form-label">Lokasi</label>
                        <input type="text" name="lokasi" id="lokasi" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="kategori" class="form-label">Pilih kategori</label>
                        <select name="kategori" id="kategori" class="form-control">
                            <option value="">-- Pilih kategori --</option>
                            <option value="Posyandu">Posyandu</option>
                            <option value="Pemeriksaan">Pemeriksaan</option>
                        </select>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="jam_mulai" class="form-label">Jam Mulai</label>
                            <input type="time" name="jam_mulai" id="jam_mulai" class="form-control">
                        </div>
                        <div class="col">
                            <label for="jam_selesai" class="form-label">Jam Selesai</label>
                            <input type="time" name="jam_selesai" id="jam_selesai" class="form-control">
                        </div>
                        <div class="col">
                            <label for="tanggal" class="form-label">Hari & Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control">
                        </div>
                    </div>

                    <div class="flex justify-between gap-4 mt-5 ">
                        <a href="{{ route('petugas.index') }}" class="btn btn-danger px-5">
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary ms-2 px-5">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
