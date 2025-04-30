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
                                        <li class="breadcrumb-item" aria-current="page">Kader</li>
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
                                <label for="nip" class="form-label">NIP <span class="text-danger">*</span></label>
                                <input type="text" id="nip" name="nip" placeholder="Masukkan NIP"
                                    value="{{ old('nip', $petugas->nip) }}" class="form-control">
                                @error('nip')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="text" id="password" name="password" placeholder="Masukkan password"
                                    value="{{ old('password', $petugas->password) }}" class="form-control">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="">
                                <label for="nama" class="form-label">Nama Lengkap <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="nama" name="nama" placeholder="Nama Petugas"
                                    value="{{ old('nama', $petugas->nama) }}" class="form-control">
                                @error('nama')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="">
                                <label for="phone-number" class="form-label">Phone number <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="phone-number" name="no_telepon" placeholder="Phone Number"
                                    value="{{ old('no_telepon', $petugas->no_telepon) }}" class="form-control">
                                @error('no_telepon')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="">
                                <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                <input type="text" id="email" name="email" placeholder="Email"
                                    value="{{ old('email', $petugas->email) }}" class="form-control">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
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
    </section>
@endsection
