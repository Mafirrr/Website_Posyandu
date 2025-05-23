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
                                <h4 class="fw-semibold mb-8">{{ $title }}</h4>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a class="text-muted text-decoration-none"
                                                href="{{ route('dashboard') }}">Home</a>
                                        </li>
                                        <li class="breadcrumb-item" aria-current="page">Edukasi</li>
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
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Thumbnail <span
                                        class="text-danger">*</span></label>
                                <input type="file" id="gambar" name="gambar"
                                    class="form-control @error('gambar') is-invalid @enderror" accept="image/*">
                                @error('gambar')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                                <div style="margin-top:10px;">
                                    @if ($berita->gambar && file_exists(storage_path('app/public/' . $berita->gambar)))
                                        <img id="gambar-preview" src="{{ asset('storage/isiberita' . $berita->gambar) }}"
                                            alt="Preview Gambar" style="max-width: 300px; display: block;">
                                    @else
                                        <img id="gambar-preview" src="#" alt="Preview Gambar"
                                            style="max-width: 300px; display: none;">
                                    @endif
                                </div>
                                <script>
                                    document.getElementById('gambar').addEventListener('change', function(event) {
                                        const [file] = this.files;
                                        if (file) {
                                            const preview = document.getElementById('gambar-preview');
                                            preview.src = URL.createObjectURL(file);
                                            preview.style.display = 'block';
                                        }
                                    });
                                </script>


                                <div class="">
                                    <label for="judul" class="form-label">Judul <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="judul" name="judul" placeholder="Judul Edukasi"
                                        class="form-control @error('judul') is-invalid @enderror"
                                        value="{{ old('judul', $berita->judul) }}">
                                    @error('judul')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="">
                                    <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                                    <input type="text" id="slug" placeholder="Slug Edukasi"
                                        class="form-control @error('slug') is-invalid @enderror"
                                        value="{{ old('slug', $berita->slug) }}" disabled>

                                    <!-- input hidden untuk slug yang dikirim -->
                                    <input type="hidden" name="slug" id="slug_hidden"
                                        value="{{ old('slug', $berita->slug) }}">

                                    @error('slug')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <script>
                                    document.getElementById('judul').addEventListener('input', function() {
                                        const title = this.value;
                                        const slug = title
                                            .toLowerCase()
                                            .trim()
                                            .replace(/[^a-z0-9\s-]/g, '')
                                            .replace(/\s+/g, '-')
                                            .replace(/-+/g, '-');

                                        // Update nilai di input disabled (untuk tampilan)
                                        document.getElementById('slug').value = slug;
                                        // Update nilai di input hidden (untuk dikirim ke server)
                                        document.getElementById('slug_hidden').value = slug;
                                    });
                                </script>



                                <div class="">
                                    <label for="isi" class="form-label">Deskripsi <span
                                            class="text-danger">*</span></label>
                                    <textarea id="isi" name="isi" rows="4" placeholder="Deskripsi Edukasi"
                                        class="form-control @error('isi') is-invalid @enderror">{{ old('isi', $berita->isi) }}</textarea>
                                    @error('isi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
                                <script>
                                    ClassicEditor.create(document.querySelector('#isi'), {
                                        toolbar: ['bold', 'italic', 'link', 'numberedList', 'bulletedList'],
                                        height: 200
                                    }).catch(error => {
                                        console.error(error);
                                    });
                                </script>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <label for="kategori_edukasi" class="form-label">Kategori Edukasi</label>
                                        <select id="kategori_edukasi" name="kategori_edukasi" class="form-control">
                                            <option value="">Pilih</option>
                                            <option value="kesehatan"
                                                {{ old('kategori_edukasi', $berita->kategori_edukasi ?? '') == 'kesehatan' ? 'selected' : '' }}>
                                                kesehatan</option>
                                            <option value="sosial"
                                                {{ old('kategori_edukasi', $berita->kategori_edukasi ?? '') == 'sosial' ? 'selected' : '' }}>
                                                sosial</option>
                                            <option value="lainnya"
                                                {{ old('kategori_edukasi', $berita->kategori_edukasi ?? '') == 'lainnya' ? 'selected' : '' }}>
                                                lainnya</option>
                                        </select>
                                        @error('kategori_edukasi')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label for="tanggal" class="form-label">Tanggal <span
                                                class="text-danger">*</span></label>
                                        <input type="date" id="tanggal" name="tanggal"
                                            class="form-control @error('tanggal') is-invalid @enderror"
                                            value="{{ old('tanggal', optional($berita->tanggal) ? \Carbon\Carbon::parse($berita->tanggal)->format('Y-m-d') : '') }}"
                                            disabled>
                                        <input type="hidden" id="tanggal" name="tanggal"
                                            value="{{ old('tanggal', optional($berita->tanggal) ? \Carbon\Carbon::parse($berita->tanggal)->format('Y-m-d') : '') }}">

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
