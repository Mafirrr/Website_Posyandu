@extends('layouts.app')

@section('main')
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Edit Jadwal</h4>

                <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" name="judul" id="judul" class="form-control"
                            value="{{ old('judul', $jadwal->judul) }}">
                    </div>

                    <div class="mb-3">
                        <label for="lokasi" class="form-label">Lokasi</label>
                        <input type="text" name="lokasi" id="lokasi" class="form-control"
                            value="{{ old('lokasi', $jadwal->lokasi) }}">
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="jam_mulai" class="form-label">Jam Mulai</label>
                            <input type="time" name="jam_mulai" id="jam_mulai" class="form-control"
                                value="{{ old('jam_mulai', $jadwal->jam_mulai) }}">
                        </div>
                        <div class="col">
                            <label for="jam_selesai" class="form-label">Jam Selesai</label>
                            <input type="time" name="jam_selesai" id="jam_selesai" class="form-control"
                                value="{{ old('jam_selesai', $jadwal->jam_selesai) }}">
                        </div>
                        <div class="col">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control"
                                value="{{ old('tanggal', $jadwal->tanggal) }}">
                        </div>
                    </div>

                    <div class="flex justify-between gap-4 mt-5">
                        <a href="{{ route('jadwal.index') }}" class="btn btn-danger px-5">
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary ms-2 px-5">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
