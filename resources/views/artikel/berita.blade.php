@extends('layouts.app')
@section('main')
    <div>
        <section class="mt-0 mb-10">
            <div class="mx-auto max-w-screen-xl ">
                <div class="bg-white dark:bg-white relative shadow-md sm:rounded-lg overflow-hidden">

                    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
                        <div class="card-body px-4 py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="">
                                    <h4 class="fw-semibold mb-8">Lainnya</h4>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a class="text-muted text-decoration-none"
                                                    href="{{ route('dashboard') }}">Data
                                                    Edukasi</a>
                                            </li>
                                            <li class="breadcrumb-item" aria-current="page">Edukasi</li>
                                        </ol>
                                    </nav>
                                </div>
                                <div class="ms-auto">
                                    <a href="{{ route('berita.create') }}" id="btn-add-contact"
                                        class="btn btn-primary d-flex align-items-center">
                                        <i class="ti ti-plus text-white me-1 fs-5"></i> Tambah berita
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-body border ">
                        <div class="row justify-content-between">
                            <div class="col-md-4 col-xl-4">
                                <form class="position-relative" action="" method="GET">

                                    <input name="search" type="text" class="form-control product-search ps-5"
                                        id="input-search" placeholder="Search...">
                                    <i
                                        class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                                </form>
                            </div>
                            <div class="col-2">
                                <a href="{{ route('berita.index', ['search' => request('search'), 'kategori' => 'olahraga']) }}"
                                   id="btn-add-contact"
                                   class="btn text-dark border border-dark d-flex align-items-center">
                                    <i class="ti ti-filter text-dark me-1 fs-5"></i> Aktif
                                </a>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card border ">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table search-table align-middle text-nowrap">
                                    <thead class="header-item">
                                        <tr>

                            <th scope="col">NO.</th>
                            <th scope="col">Thumbnail</th>
                            <th scope="col">Title</th>
                            {{-- <th scope="col">Deskripsi</th> --}}
                            <th scope="col">Kategori</th>
                            <th scope="col">Date</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($artikels as $berita)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>
                                    <img src="storage/{{ $berita->gambar }}" alt="Thumbnail" class="img-thumbnail" style="width: 64px; height: 64px; object-fit: cover;">
                                </td>
                                <td>{{ $berita->judul }}</td>
                                {{-- <td>{!! Str::limit($berita->isi, 50, '') !!}</td> --}}
                                <td>{{ $berita->kategori_edukasi}}</td>
                                <td>{{ $berita->created_at->toDateString() }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('berita.edit', $berita->id) }}"
                                           class="btn btn-warning d-flex align-items-center gap-2 px-3 py-2 rounded"
                                           title="Edit">

                                           <span class="text-white fw-bold">Edit</span>
                                        </a>

                                        <form action="{{ route('berita.destroy', $berita->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus data ini?');"
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-danger d-flex align-items-center gap-2 px-3 py-2 rounded"
                                                    title="Hapus">

                                                <span class="text-white fw-bold">Hapus</span>
                                            </button>
                                        </form>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

                            <form method="GET" action="{{ route('berita.index') }}" class="mt-4">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="per_page" class="form-label">Per Page</label>
                                        <select name="per_page" id="per_page" class="form-select"
                                            onchange="this.form.submit()">
                                            <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5
                                            </option>
                                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10
                                            </option>
                                            <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20
                                            </option>
                                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50
                                            </option>
                                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </form>

                            <div class="mt-3">
                                {{ $artikels->appends(['per_page' => request('per_page')])->links() }}
                            </div>
        </section>
    </div>
@endsection
