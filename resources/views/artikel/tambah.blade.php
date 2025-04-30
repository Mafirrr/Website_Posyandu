@extends('layouts.app')
@section('main')
    <section class="mt-0 mb-10">
        <div class="mx-auto max-w-screen-xl">
            <!-- Start coding here -->
            <div class="bg-white dark:bg-white relative shadow-md sm:rounded-lg overflow-hidden">

                <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
                    <div class="card-body px-4 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">
                                <h4 class="fw-semibold mb-8">{{$title}}</h4>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                                        </li>
                                        <li class="breadcrumb-item" aria-current="page">Berita</li>
                                    </ol>
                                </nav>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card card-body border ">
                    <form action="{{ $action_form }}" method="post"enctype='multipart/form-data'>
                        @csrf
                        @method("$method")
                        <div class="d-flex flex-column gap-3">

                            <div class="">
                                <label for="gambar" class="form-label">Thumbnail <span class="text-danger">*</span></label>
                                <input type="file" id="gambar" name="gambar" class="form-control @error('thumbnail') is-invalid @enderror">
                                @error('thumbnail')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="">
                                <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                                <input type="text" id="slug" name="slug" placeholder="Slug Berita" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug',$berita->slug) }}">
                                @error('slug')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="">
                                <label for="judul" class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" id="judul" name="judul" placeholder="Judul Berita" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul',$berita->judul) }}">
                                @error('judul')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="">
                                <label for="isi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                <textarea id="isi" name="isi" rows="4" placeholder="Deskripsi Berita" class="form-control @error('isi') is-invalid @enderror">{{ old('isi',$berita->isi) }}</textarea>
                                @error('isi')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="">
                                <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                                <select id="kategori" name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($kategori as $kategori)
                                        <option value="{{ $kategori->id }}" {{ old('kategori_id',$berita->kategori_id) == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama }}</option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="">
                                <label for="tanggal" class="form-label">Tanggal <span class="text-dangr">*</span></label>
                                <input type="date" id="tanggal" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal',$berita->tanggal) }}">
                                @error('tanggal')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="d-flex justify-between gap-4 mt-5">
                                <a href="{{ route('berita.index') }}" class="btn btn-danger px-5">
                                    Batal
                                </a>
                                <button type="submit" class="btn btn-primary ms-2 px-5">
                                    Tambah
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
