@extends('layouts.app')
@section('main')
    <section class="mt-0 mb-10">
        <div class="mx-auto max-w-screen-xl ">
            <!-- Start coding here -->
            <div class="bg-white dark:bg-white relative shadow-md sm:rounded-lg overflow-hidden">

                <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
                    <div class="card-body px-4 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">
                                <h4 class="fw-semibold mb-8">{{ $title }}</h4>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a class="text-muted text-decoration-none"
                                                href="{{ route('dashboard') }}">Home</a>
                                        </li>
                                        <li class="breadcrumb-item" aria-current="page">Ibu Hamil</li>
                                    </ol>
                                </nav>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card card-body border ">
                    <form action="{{ $action_form }}" method="post">
                        @csrf
                        @method($method)
                        <div class=" d-flex flex-column gap-3">

                            <div class="">
                                {{-- NIK --}}
                                <label for="nik" class="form-label">NIK <span class="text-danger">*</span></label>
                                <input type="number" id="nik" name="nik" placeholder="Masukkan NIK"
                                    value="{{ old('nik', $anggota->nik) }}" class="form-control">
                                @error('nik')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="">
                                {{-- Nama --}}
                                <label for="nama" class="form-label">Nama Lengkap <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="nama" name="nama" placeholder="Nama Ibu Hamil"
                                    value="{{ old('nama', $anggota->nama) }}" class="form-control">
                                @error('nama')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="">
                                {{-- Nomor JKN --}}
                                <label for="nomor-jkn" class="form-label">Nomor JKN <span
                                        class="text-danger">*</span></label>
                                <input type="number" id="nomor-jkn" name="no_jkn" placeholder="Nomor JKN"
                                    value="{{ old('no_jkn', $anggota->no_jkn) }}" class="form-control">
                                @error('no_jkn')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="">
                                {{-- Fasilitas Kesehatan 1 --}}
                                <label for="faskes-1" class="form-label">Fasilitas Kesehatan Tingkat 1 <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="faskes-1" name="faskes_tk1"
                                    placeholder="Fasilitas Kesehatan Tingkat 1"
                                    value="{{ old('faskes_tk1', $anggota->faskes_tk1) }}" class="form-control">
                                @error('faskes_tk1')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="">
                                {{-- Fasilitas Rujukan --}}
                                <label for="faskes-rujukan" class="form-label">Fasilitas Kesehatan Rujukan <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="faskes-rujukan" name="faskes_rujukan"
                                    placeholder="Fasilitas Kesehatan Rujukan"
                                    value="{{ old('faskes_rujukan', $anggota->faskes_rujukan) }}" class="form-control">
                                @error('faskes_rujukan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Tanggal Lahir & Jenis Kelamin --}}
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <label for="tanggal-lahir" class="form-label">Tanggal Lahir <span
                                            class="text-danger">*</span></label>
                                    <input type="date" id="tanggal-lahir" name="tanggal_lahir"
                                        value="{{ old('tanggal_lahir', $anggota->tanggal_lahir) }}" class="form-control">
                                    @error('tanggal_lahir')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-12">
                                    <label for="jenis-kelamin" class="form-label">Golongan Darah</label>
                                    <select id="golongan_darah" name="golongan_darah" class="form-control">
                                        <option value="">Pilih</option>
                                        <option value="A-"
                                            {{ old('golongan_darah', $anggota->golongan_darah ?? '') == 'A-' ? 'selected' : '' }}>
                                            A-</option>
                                        <option value="A+"
                                            {{ old('golongan_darah', $anggota->golongan_darah ?? '') == 'A+' ? 'selected' : '' }}>
                                            A+</option>
                                        <option value="B-"
                                            {{ old('golongan_darah', $anggota->golongan_darah ?? '') == 'B-' ? 'selected' : '' }}>
                                            B-</option>
                                        <option value="B+"
                                            {{ old('golongan_darah', $anggota->golongan_darah ?? '') == 'B+' ? 'selected' : '' }}>
                                            B+</option>
                                        <option value="AB-"
                                            {{ old('golongan_darah', $anggota->golongan_darah ?? '') == 'AB-' ? 'selected' : '' }}>
                                            AB-</option>
                                        <option value="AB+"
                                            {{ old('golongan_darah', $anggota->golongan_darah ?? '') == 'AB+' ? 'selected' : '' }}>
                                            AB+</option>
                                        <option value="O-"
                                            {{ old('golongan_darah', $anggota->golongan_darah ?? '') == 'O-' ? 'selected' : '' }}>
                                            O-</option>
                                        <option value="O+"
                                            {{ old('golongan_darah', $anggota->golongan_darah ?? '') == 'O-' ? 'selected' : '' }}>
                                            O+</option>
                                    </select>
                                    @error('golongan_darah')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="">
                                {{-- Tempat Lahir --}}
                                <label for="tempat-lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" id="tempat-lahir" name="tempat_lahir" placeholder="Tempat Lahir"
                                    value="{{ old('tempat_lahir', $anggota->tempat_lahir) }}" class="form-control">
                                @error('tempat_lahir')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="">
                                {{-- Pekerjaan --}}
                                <label for="pekerjaan" class="form-label">Pekerjaan <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="pekerjaan" name="pekerjaan" placeholder=" Pekerjaan"
                                    value="{{ old('pekerjaan', $anggota->pekerjaan) }}" class="form-control">
                                @error('pekerjaan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="">

                                {{-- Nomor Telepon --}}
                                <label for="phone-number" class="form-label">Phone number <span
                                        class="text-danger">*</span></label>
                                <input type="tel" id="phone-number" name="no_telepon" placeholder="Phone Number"
                                    value="{{ old('no_telepon', $anggota->no_telepon) }}" class="form-control">
                                @error('no_telepon')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="">
                                {{-- Alamat --}}
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" id="alamat" name="alamat" placeholder="Masukkan Alamat"
                                    value="{{ old('alamat', $anggota->alamat) }}" class="form-control">
                                @error('alamat')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            @if ($method === 'PUT')
                                <div class="">
                                    <label for="status" class="form-label">Status Pengguna</label>
                                    <div class="w-full">
                                        <select id="status" name="status" class="form-control">
                                            <option value="1"
                                                {{ old('aktif', $anggota->aktif) == 1 ? 'selected' : '' }}>Aktif
                                            </option>
                                            <option value="0"
                                                {{ old('aktif', $anggota->aktif) == 0 ? 'selected' : '' }}>Nonaktif
                                            </option>
                                        </select>
                                        @error('status')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex justify-between gap-4 mt-5 ">
                            <a href="{{ route('anggota.index') }}" class="btn btn-danger px-5">
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
    </section>
@endsection
