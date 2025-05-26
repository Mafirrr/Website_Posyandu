@extends('layouts.app')

@section('main')
    <div class="container mt-4">
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <h4 class="fw-semibold mb-8">Pelayanan Posyandu</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="#">Pelayanan
                                Posyandu</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Jadwal Posyandu</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Pembuatan Jadwal</h4>

                <form action="{{ route('jadwal.store') }}" method="POST" id="jadwalForm">
                    @csrf

                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" name="judul" id="judul" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="lokasi" class="form-label">Lokasi</label>
                        <input type="text" name="lokasi" id="lokasi" class="form-control" required>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="jam_mulai" class="form-label">Jam Mulai</label>
                            <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" required>
                        </div>
                        <div class="col">
                            <label for="jam_selesai" class="form-label">Jam Selesai</label>
                            <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" required>
                            <div class="invalid-feedback" id="jam_selesai_error"></div>
                        </div>
                        <div class="col">
                            <label for="tanggal" class="form-label">Hari & Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" required
                                   min="{{ date('Y-m-d') }}">
                        </div>
                    </div>

                    <div class="flex justify-between gap-4 mt-5 ">
                        <button type="submit" class="btn btn-primary ms-2 px-5">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card border mb-4">
            <div class="card-body">
                <h4 class="card-title mb-4">Daftar Jadwal</h4>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table search-table align-middle text-nowrap">
                        <thead class="header-item">
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Lokasi</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwals as $key => $jadwal)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $jadwal->judul }}</td>
                                    <td>{{ $jadwal->lokasi }}</td>
                                    <td>{{ $jadwal->jam_mulai }}</td>
                                    <td>{{ $jadwal->jam_selesai }}</td>
                                    <td>{{ $jadwal->tanggal }}</td>
                                    <td>
                                        @if (\Carbon\Carbon::parse($jadwal->tanggal)->isFuture())
                                            <a href="{{ route('jadwal.edit', $jadwal->id) }}" class="btn btn-sm btn-warning"
                                                title="Edit">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                        @endif

                                        <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jamMulai = document.getElementById('jam_mulai');
            const jamSelesai = document.getElementById('jam_selesai');
            const jamSelesaiError = document.getElementById('jam_selesai_error');
            const form = document.getElementById('jadwalForm');

            function validateTime() {
                if (jamMulai.value && jamSelesai.value) {
                    if (jamSelesai.value <= jamMulai.value) {
                        jamSelesai.classList.add('is-invalid');
                        jamSelesaiError.textContent = 'Jam selesai harus lebih dari jam mulai';
                        return false;
                    } else {
                        jamSelesai.classList.remove('is-invalid');
                        jamSelesaiError.textContent = '';
                        return true;
                    }
                }
                return true;
            }
            jamMulai.addEventListener('change', validateTime);
            jamSelesai.addEventListener('change', validateTime);

            form.addEventListener('submit', function(e) {
                if (!validateTime()) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Waktu Salah!',
                        html: '<div style="text-align: center;"><strong>Jam selesai harus lebih dari jam mulai</strong><br></div>',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#3085d6'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            jamSelesai.focus();
                        }
                    });
                }
            });

            const today = new Date().toISOString().split('T')[0];
            document.getElementById('tanggal').setAttribute('min', today);
        });
    </script>
@endsection
