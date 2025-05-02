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
                                    <h4 class="fw-semibold mb-8">Home</h4>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a class="text-muted text-decoration-none" href="../main/index.html">Data
                                                    Pengguna</a>
                                            </li>
                                            <li class="breadcrumb-item" aria-current="page">Petugas</li>
                                        </ol>
                                    </nav>
                                </div>
                                <div class="ms-auto">
                                    <a href="{{ route('kader.add') }}" id="btn-add-contact"
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
                                <form class="position-relative">
                                    <input type="text" class="form-control product-search ps-5" id="input-search"
                                        placeholder="Search...">
                                    <i
                                        class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                                </form>
                            </div>
                            <div class=" col-2">
                                <a href="{{ route('kader.add') }}" id="btn-add-contact"
                                    class="btn text-dark border border-dark d-flex align-items-center">
                                    <i class="ti ti-filter text-dark me-1 fs-5"></i> Filter
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
                                            <th>No</th>
                                            <th>NIP</th>
                                            <th>Nama</th>
                                            <th>No Telepon</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kader as $petugas)
                                            <tr class="border-b dark:border-gray-500">
                                                <th scope="row"
                                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                                                    {{ $loop->iteration }}
                                                </th>
                                                <td class="px-4 py-3">{{ $petugas->nip }}</td>
                                                <td class="px-4 py-3">{{ $petugas->nama }}</td>
                                                <td class="px-4 py-3">{{ $petugas->no_telepon }}</td>
                                                <td class="px-4 py-3">{{ $petugas->email }}</td>
                                                <td class="d-flex gap-2">
                                                    <a href="{{ route('kader.edit', $petugas->id) }}"
                                                        class="btn btn-warning d-flex align-items-center" title="Edit">
                                                        <i class="ti ti-edit text-white fs-5"></i>
                                                    </a>
                                                    <form action="{{ route('kader.destroy', $petugas->id) }}" method="POST"
                                                        onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-danger d-flex align-items-center" title="Hapus">
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
                </div>
            </div>
        </section>
    </div>
@endsection
