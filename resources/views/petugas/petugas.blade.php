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
                                    <h4 class="fw-semibold mb-8">Data Pengguna</h4>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a class="text-muted text-decoration-none"
                                                    href="../main/index.html">Petugas</a>
                                            </li>
                                            <li class="breadcrumb-item" aria-current="page">Bidan</li>
                                        </ol>
                                    </nav>
                                </div>
                                <div class="ms-auto">
                                    <a href="{{ route('petugas.add') }}" id="btn-add-contact"
                                        class="btn btn-primary d-flex align-items-center">
                                        <i class="ti ti-plus text-white me-1 fs-5"></i> Tambah petugas
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-body border ">
                        <div class="row justify-content-between">
                            <div class="col-md-4 col-xl-4">
                                <form class="position-relative" method="GET" action="{{ route('petugas.index') }}">
                                    <input type="text" name="search" class="form-control product-search ps-5"
                                        id="input-search" placeholder="Search..." value="{{ request('search') }}" />
                                    <i
                                        class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                                </form>
                            </div>
                            {{-- <div class=" col-2">
                                <a href="{{ route('petugas.add') }}" id="btn-add-contact"
                                    class="btn text-dark border border-dark d-flex align-items-center">
                                    <i class="ti ti-filter text-dark me-1 fs-5"></i> Filter
                                </a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card border ">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table search-table align-middle text-nowrap">
                                    <thead class="header-item">
                                        <tr>
                                            <th>No</th>
                                            <th>NIP</th>
                                            <th>Nama</th>
                                            <th>No Telepon</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($petugas as $p)
                                            <tr class="border-b dark:border-gray-500">
                                                <th scope="row"
                                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                                                    {{ $loop->iteration }}
                                                </th>
                                                <td class="px-4 py-3">{{ $p->nip }}</td>
                                                <td class="px-4 py-3">{{ $p->nama }}</td>
                                                <td class="px-4 py-3">{{ $p->no_telepon }}</td>
                                                <td class="px-4 py-3">{{ $p->email }}</td>
                                                <td class="d-flex gap-2">
                                                    <a href="{{ route('petugas.edit', $p->id) }}"
                                                        class="btn btn-warning d-flex align-items-center" title="Edit">
                                                        <i class="ti ti-edit text-white fs-5"></i>
                                                    </a>
                                                    <form id="form-delete-{{ $p->id }}"
                                                        action="{{ route('petugas.destroy', $p->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button"
                                                            class="btn btn-danger d-flex align-items-center btn-delete"
                                                            data-id="{{ $p->id }}">
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
                    <form method="GET" action="{{ route('petugas.index') }}">
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
                                {{ $petugas->appends(['per_page' => request('per_page')])->links() }}
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
