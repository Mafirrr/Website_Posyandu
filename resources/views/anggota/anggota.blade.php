@extends('layouts.app')
@section('main')
    <div>

        <section class="mt-0 mb-10">
            <div class="mx-auto max-w-screen-xl ">
                <!-- Start coding here -->
                <div class="bg-white dark:bg-white relative shadow-md sm:rounded-lg overflow-hidden">

                    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
                        <div class="card-body px-4 py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="">
                                    <h4 class="fw-semibold mb-8">Data Pengguna</h4>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                Data Pengguna
                                            </li>
                                            <li class="breadcrumb-item" aria-current="page">Ibu Hamil</li>
                                        </ol>
                                    </nav>
                                </div>
                                <div class="ms-auto">

                                    <a href="{{ route('anggota.create') }}" id="btn-add-contact"
                                        class="btn btn-primary d-flex align-items-center">
                                        <i class="ti ti-plus text-white me-1 fs-5"></i> Tambah Ibu Hamil
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-body border ">
                        <div class="row justify-content-between">
                            <div class="col-md-4 col-xl-4">
                                <form class="position-relative" method="GET" action="{{ route('anggota.index') }}">
                                    <input type="text" name="search" class="form-control product-search ps-5"
                                        value="{{ request('search') }}" placeholder="Search...">
                                    <i
                                        class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>

                                    <!-- pertahankan parameter lain -->
                                    @if (request()->has('aktif'))
                                        <input type="hidden" name="aktif" value="{{ request('aktif') }}">
                                    @endif
                                    @if (request()->has('per_page'))
                                        <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                                    @endif
                                </form>
                            </div>
                            <div class=" col-2">
                                <a class="btn text-dark border border-dark d-flex align-items-center" id="drop2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-chevron-down fs-4">Status Pengguna</i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="{{ route('anggota.index', array_merge(request()->query(), ['aktif' => null])) }}"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <p class="mb-0 fs-3">All</p>
                                        </a>
                                        <a href="{{ route('anggota.index', array_merge(request()->query(), ['aktif' => 1])) }}"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <p class="mb-0 fs-3">Aktif</p>
                                        </a>
                                        <a href="{{ route('anggota.index', array_merge(request()->query(), ['aktif' => 0])) }}"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <p class="mb-0 fs-3">Nonaktif</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border ">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table search-table align-middle text-nowrap">
                                    <thead class="header-item">
                                        <tr>
                                            <th>No</th>
                                            <th>NIK</th>
                                            <th>Name</th>
                                            <th>Posyandu</th>
                                            <th>No Telepon</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($anggotas as $key => $anggota)
                                            <tr class="border-b dark:border-gray-500">
                                                <th scope="row"
                                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                                                    {{ $anggotas->firstItem() + $key }}
                                                </th>
                                                <td class="px-4 py-3">{{ $anggota->nik }}</td>
                                                <td class="px-4 py-3">{{ $anggota->nama }}</td>
                                                <td class="px-4 py-3">{{ $anggota->posyandu->nama ?? '-' }}</td>
                                                <td class="px-4 py-3">{{ $anggota->no_telepon }}</td>
                                                <td class="px-4 py-3 ">
                                                    <div class="badge {{ $anggota->aktif ? 'bg-success' : 'bg-danger' }}">
                                                        {{ $anggota->aktif ? 'Aktif' : 'Nonaktif' }}
                                                    </div>
                                                </td>
                                                <td class="d-flex gap-2">
                                                    <a href="{{ route('anggota.edit', $anggota->id) }}"
                                                        class="btn btn-warning d-flex align-items-center" title="Edit">
                                                        <i class="ti ti-edit text-white fs-5"></i>
                                                    </a>
                                                    <form id="form-delete-{{ $anggota->id }}"
                                                        action="{{ route('anggota.destroy', $anggota->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button"
                                                            class="btn btn-danger btn-delete d-flex align-items-center"
                                                            data-id="{{ $anggota->id }}" title="Hapus">
                                                            <i class="ti ti-trash text-white fs-5"></i>
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
                    <form method="GET" action="{{ route('anggota.index') }}">
                        <div class="py-4 px-3">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center mb-3">
                                    <label for="per_page" class="form-label w-32 me-3">Per Page</label>
                                    <select name="per_page" onchange="this.form.submit()"
                                        class="form-select form-select-sm w-auto">
                                        <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
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
                                {{ $anggotas->appends(['per_page' => request('per_page')])->links() }}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </div>
@endsection
@push('scripts')
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>
@endpush
