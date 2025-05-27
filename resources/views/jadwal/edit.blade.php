@extends('layouts.app')

@section('main')
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Edit Jadwal</h4>

                <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST" id="editjadwalForm">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" name="judul" id="judul" class="form-control"
                            value="{{ old('judul', $jadwal->judul) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="lokasi" class="form-label">Lokasi</label>
                        <input type="text" name="lokasi" id="lokasi" class="form-control"
                            value="{{ old('lokasi', $jadwal->lokasi) }}" required>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="jam_mulai" class="form-label">Jam Mulai</label>
                            <input type="time" name="jam_mulai" id="jam_mulai" class="form-control"
                                value="{{ old('jam_mulai', $jadwal->jam_mulai) }}" required>
                        </div>
                        <div class="col">
                            <label for="jam_selesai" class="form-label">Jam Selesai</label>
                            <input type="time" name="jam_selesai" id="jam_selesai" class="form-control"
                                value="{{ old('jam_selesai', $jadwal->jam_selesai) }}" required>
                            <div class="invalid-feedback" id="jam_selesai_error"></div>
                        </div>
                        <div class="col">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control"
                                value="{{ old('tanggal', $jadwal->tanggal) }}" required>
                            <div class="invalid-feedback" id="tanggal_error"></div>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jamMulai = document.getElementById('jam_mulai');
            const jamSelesai = document.getElementById('jam_selesai');
            const tanggal = document.getElementById('tanggal');
            const form = document.getElementById('editjadwalForm');

            const today = new Date().toISOString().split('T')[0];
            tanggal.setAttribute('min', today);

            function validateTime() {
                const startTime = jamMulai.value;
                const endTime = jamSelesai.value;

                if (startTime && endTime) {
                    if (endTime <= startTime) {
                        jamSelesai.classList.add('is-invalid');
                        document.getElementById('jam_selesai_error').textContent = 'Jam selesai harus lebih dari jam mulai';
                        return false;
                    } else {
                        jamSelesai.classList.remove('is-invalid');
                        document.getElementById('jam_selesai_error').textContent = '';
                        return true;
                    }
                }
                return true;
            }

            function validateDate() {
                const selectedDate = tanggal.value;
                const todayDate = new Date().toISOString().split('T')[0];

                if (selectedDate && selectedDate < todayDate) {
                    tanggal.classList.add('is-invalid');
                    document.getElementById('tanggal_error').textContent = 'Tanggal tidak boleh kurang dari hari ini';
                    return false;
                } else {
                    tanggal.classList.remove('is-invalid');
                    document.getElementById('tanggal_error').textContent = '';
                    return true;
                }
            }

            jamMulai.addEventListener('change', validateTime);
            jamSelesai.addEventListener('change', validateTime);
            tanggal.addEventListener('change', validateDate);

            form.addEventListener('submit', function(e) {
                const isTimeValid = validateTime();
                const isDateValid = validateDate();

                if (!isTimeValid || !isDateValid) {
                    e.preventDefault();
                    alert('Mohon perbaiki kesalahan pada form sebelum melanjutkan');
                }
            });
            validateTime();
            validateDate();
        });
    </script>
@endsection
