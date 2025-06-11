@extends('layouts.app')

@section('main')
    <div>
        <section class="mt-0 mb-10">
            <div class="mx-auto max-w-screen-xl">
                <div class="bg-white dark:bg-white relative shadow-md sm:rounded-lg overflow-hidden">

                    <!-- Breadcrumb -->
                    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
                        <div class="card-body px-4 py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="fw-semibold mb-8">Riwayat Pemeriksaan</h4>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a class="text-muted text-decoration-none"
                                                    href="{{ route('riwayat.index') }}">Pelayanan Posyandu</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">Riwayat Pemeriksaan
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Search & Filter -->
                    <div class="card card-body border mb-4">
                        <form id="searchFilterForm" method="GET" action="">
                            <div class="row g-3 justify-content-between">
                                <!-- Search Nama Anggota -->
                                <div class="col-md-4">
                                    <input name="search" type="text" class="form-control"
                                        placeholder="Cari nama anggota..." value="{{ request('search') }}">
                                </div>

                                <!-- Hidden Input untuk Jenis Pemeriksaan -->
                                <input type="hidden" name="jenis_pemeriksaan" id="jenisPemeriksaanInput"
                                    value="{{ request('jenis_pemeriksaan') }}">

                                <!-- Tombol Buka Modal Filter -->
                                <div class="col-2">
                                    <a id="btn-add-contact"
                                        class="btn text-dark border border-dark d-flex align-items-center"
                                        data-bs-toggle="modal" data-bs-target="#filterModal">
                                        <i class="ti ti-filter text-dark me-1 fs-5"></i> Filter
                                    </a>
                                </div>
                            </div>
                            <!-- Modal Filter -->
                            <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="filterModalLabel">Filter Jenis Pemeriksaan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Tutup"></button>
                                        </div>
                                        <div class="modal-body">
                                            <select name="jenis_pemeriksaan" id="jenisPemeriksaanSelect"
                                                class="form-select">
                                                <option value=""
                                                    {{ request('jenis_pemeriksaan') == '' ? 'selected' : '' }}>
                                                    -- Semua Jenis Pemeriksaan --
                                                </option>
                                                @foreach ($jenisPemeriksaans as $key => $label)
                                                    <option value="{{ $key }}"
                                                        {{ request('jenis_pemeriksaan') == $key ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary"
                                                id="applyFilterBtn">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Accordion and Table -->
                    <div class="card border">
                        <div class="card-body">

                            <div class="accordion" id="accordionExample">
                                @if ($paginatedGrouped->isEmpty())
                                    <div class="text-center py-5">
                                        <p class="text-muted">Data tidak ditemukan.</p>
                                    </div>
                                @else
                                    @foreach ($paginatedGrouped as $group)
                                        <!-- Accordion Item untuk tiap tanggal -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header"
                                                id="heading-{{ \Illuminate\Support\Str::slug($group['tanggal']) }}">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapse-{{ \Illuminate\Support\Str::slug($group['tanggal']) }}"
                                                    aria-expanded="false"
                                                    aria-controls="collapse-{{ \Illuminate\Support\Str::slug($group['tanggal']) }}">
                                                    <div class="d-flex flex-column">
                                                        <span>Jadwal Pemeriksaan</span>
                                                        <small class="text-muted pt-2">Tanggal Pemeriksaan:
                                                            {{ \Carbon\Carbon::parse($group['tanggal'])->format('d-m-Y') }}</small>
                                                    </div>
                                                </button>
                                            </h2>
                                            <div id="collapse-{{ \Illuminate\Support\Str::slug($group['tanggal']) }}"
                                                class="accordion-collapse collapse"
                                                aria-labelledby="heading-{{ \Illuminate\Support\Str::slug($group['tanggal']) }}"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th scope="col">NO.</th>
                                                                    <th scope="col">Nama Anggota</th>
                                                                    <th scope="col">Jenis Pemeriksaan</th>
                                                                    <th scope="col">Tanggal Pemeriksaan</th>
                                                                    <th scope="col">Waktu Pemeriksaan</th>
                                                                    <th scope="col">Hasil Pemeriksaan</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($group['pemeriksaans'] as $index => $pemeriksaan)
                                                                    <tr>
                                                                        <td>{{ $index + 1 }}</td>
                                                                        <td>{{ $pemeriksaan['nama_anggota'] }}</td>
                                                                        <td>{{ $pemeriksaan['jenis_pemeriksaan'] }}</td>
                                                                        <td>{{ \Carbon\Carbon::parse($pemeriksaan['tanggal'])->format('d-m-Y') }}
                                                                        </td>
                                                                        <td>{{ $pemeriksaan['waktu'] }}</td>
                                                                        <td>
                                                                            <a href="{{ route('detail.riwayat', $pemeriksaan['id']) }}"
                                                                                class="btn btn-sm btn-primary">Detail</a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                                <!-- Per Page inside card body -->
                                <form method="GET" action="{{ route('riwayat.index') }}">
                                    <!-- Preserve existing filters -->
                                    @if (request('search'))
                                        <input type="hidden" name="search" value="{{ request('search') }}">
                                    @endif
                                    @if (request('jenis_pemeriksaan'))
                                        <input type="hidden" name="jenis_pemeriksaan"
                                            value="{{ request('jenis_pemeriksaan') }}">
                                    @endif

                                    <div class="py-4 px-3">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center mb-3">
                                                <label for="per_page" class="form-label w-32 me-3">Per Page</label>
                                                <select name="per_page" onchange="this.form.submit()"
                                                    class="form-select form-select-sm w-auto">
                                                    <option value="5"
                                                        {{ request('per_page') == 5 ? 'selected' : '' }}>5
                                                    </option>
                                                    <option value="10"
                                                        {{ request('per_page') == 10 ? 'selected' : '' }}>10
                                                    </option>
                                                    <option value="20"
                                                        {{ request('per_page') == 20 ? 'selected' : '' }}>20
                                                    </option>
                                                    <option value="50"
                                                        {{ request('per_page') == 50 ? 'selected' : '' }}>50
                                                    </option>
                                                    <option value="100"
                                                        {{ request('per_page') == 100 ? 'selected' : '' }}>100
                                                    </option>
                                                </select>
                                            </div>
                                            {{ $paginatedGrouped->appends(request()->except('page'))->links() }}
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('applyFilterBtn').addEventListener('click', function() {
            var selectedJenis = document.getElementById('jenisPemeriksaanSelect').value;
            document.getElementById('jenisPemeriksaanInput').value = selectedJenis;
            document.getElementById('searchFilterForm').submit();
        });
    </script>
@endpush
