@extends("layouts.app")
@section("main")
    <div>

        <section class="mt-0 mb-10">
            <div class="mx-auto max-w-screen-xl ">
                <!-- Start coding here -->
                <div class="bg-white dark:bg-white relative shadow-md sm:rounded-lg overflow-hidden">

                    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
                        <div class="card-body px-4 py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="">
                                    <h4 class="fw-semibold mb-8">Contact</h4>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a class="text-muted text-decoration-none"
                                                    href="../main/index.html">Home</a>
                                            </li>
                                            <li class="breadcrumb-item" aria-current="page">Contact</li>
                                        </ol>
                                    </nav>
                                </div>
                                <div class="ms-auto">
                                    <a href="{{ route('anggota.add') }}" id="btn-add-contact"
                                        class="btn btn-primary d-flex align-items-center">
                                        <i class="ti ti-users text-white me-1 fs-5"></i> Tambah anggota
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
                                        placeholder="Search Contacts...">
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
                    <div class="card border ">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table search-table align-middle text-nowrap">
                                    <thead class="header-item">
                                        <tr>
                                            <th>
                                                <div class="n-chk align-self-center text-center">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input primary"
                                                            id="contact-check-all">
                                                        <label class="form-check-label" for="contact-check-all"></label>
                                                        <span class="new-control-indicator"></span>
                                                    </div>
                                                </div>
                                            </th>
                                            <th>NIK</th>
                                            <th>Name</th>
                                            <th>Alamat</th>
                                            <th>No Telepon</th>
                                            <th>Status</th>
                                            <th>Action</th>
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
                                                <td class="px-4 py-3 ">
                                                    <div class="badge {{ $anggota->aktif ? 'bg-success' : 'bg-danger' }}">
                                                        {{ $anggota->aktif ? 'Aktif' : 'Nonaktif' }}
                                                    </div>
                                                </td>
                                                <td class="d-flex gap-2">
                                                    <button class="btn btn-warning" type="button"
                                                        onclick="window.location='{{ route('anggota.edit', $anggota->id) }}'">
                                                        Edit
                                                    </button>
                                                    <form action="{{ route('anggota.destroy', $anggota->id) }}" method="POST"
                                                        onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">
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
                    {{-- <div class="overflow-x-auto">
                        <table class="datatable w-full text-sm text-left text-black dark:text-black">
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
                                    <td class="px-4 py-3 {{ $anggota->aktif ? 'text-green-500' : 'text-red-500' }}">
                                        {{ $anggota->aktif ? 'Aktif' : 'Nonaktif' }}
                                    </td>
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
                    </div> --}}

                    <form method="GET" action="{{ route('anggota.index') }}">
                        <div class="py-4 px-3">
                            <div class="flex">
                                <div class="flex space-x-4 items-center mb-3">
                                    <label class="w-32 text-sm font-medium text-gray-900">Per Page</label>
                                    <select name="per_page" onchange="this.form.submit()"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                        <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                        <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100
                                        </option>
                                    </select>
                                </div>
                            </div>
                            {{ $anggotas->appends(['per_page' => request('per_page')])->links() }}
                        </div>
                    </form>

                </div>
            </div>
        </section>

    </div>
@endsection
