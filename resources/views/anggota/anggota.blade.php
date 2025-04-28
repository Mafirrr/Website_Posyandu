@extends('layouts.app')
@section('main')
    <div>
        <div class="flex items-center justify-between m-5">
            <h2 class="text-2xl font-semibold">Data Anggota</h2>
            <button type="button" onclick="window.location='{{ route('anggota.add') }}'"
                class="py-2 px-4 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                Tambah Anggota
            </button>
        </div>

        <section class="mt-5 mb-10">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <!-- Start coding here -->
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
                                            <li class="breadcrumb-item" aria-current="page">Ibu Hamil</li>
                                        </ol>
                                    </nav>
                                </div>
                                <div class="ms-auto">

                                    <a href="{{ route('anggota.add') }}" id="btn-add-contact"
                                        class="btn btn-primary d-flex align-items-center">
                                        <i class="ti ti-plus text-white me-1 fs-5"></i> Tambah anggota
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
                                <a href="{{ route('anggota.add') }}" id="btn-add-contact"
                                    class="btn text-dark border border-dark d-flex align-items-center">
                                    <i class="ti ti-filter text-dark me-1 fs-5"></i> Filter
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-black dark:text-black">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                                <tr>
                                    <th scope="col" class="px-4 py-3">NO.</th>
                                    <th scope="col" class="px-4 py-3">NIK</th>
                                    <th scope="col" class="px-4 py-3">Nama</th>
                                    <th scope="col" class="px-4 py-3">Alamat</th>
                                    <th scope="col" class="px-4 py-3">No Telepon</th>
                                    <th scope="col" class="px-4 py-3">Status</th>
                                    <th scope="col" class="px-4 py-3">
                                        <span class="sr-only">Actions</span>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($anggotas as $anggota)
                                    <tr class="border-b dark:border-gray-500">
                                        <th scope="row"
                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                                            {{ $anggota->id }}
                                        </th>
                                        <td class="px-4 py-3">{{ $anggota->nik }}</td>
                                        <td class="px-4 py-3">{{ $anggota->nama }}</td>
                                        <td class="px-4 py-3">{{ $anggota->alamat }}</td>
                                        <td class="px-4 py-3">{{ $anggota->no_telepon }}</td>
                                        <td class="px-4 py-3 text-green-500">
                                            Aktif</td>
                                        <td class="px-4 py-3 flex items-center justify-end space-x-2">
                                            <button class="px-3 py-1 bg-green-500 text-white rounded" type="button"
                                                onclick="window.location='{{ route('anggota.edit', $anggota->id) }}'">
                                                Edit
                                            </button>
                                            <form action="{{ route('anggota.destroy', $anggota->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded">
                                                    Hapus
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
                                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                        <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
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
