@extends('layouts.app')

@section('main')
    <div class="row">

        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Grafik Pengunjung</h5>
                        </div>
                        <div>
                            <select class="form-select w-auto" id="yearSelector">
                                @foreach (array_keys($chartData) as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="chart"></div>
                </div>
            </div>
        </div>


        <div class="col-lg-12 mt-4">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title fw-semibold">Riwayat Pemeriksaan</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Ibu Hamil</th>
                                    <th>Jenis Pemeriksaan</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Lokasi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($mapped as $item)
                                    <tr>
                                        <td>{{ $item['nama_anggota'] }}</td>
                                        <td>{{ $item['jenis_pemeriksaan'] }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item['tanggal_pemeriksaan'])->format('d-m-Y') }}</td>
                                        <td>{{ $item['waktu'] }}</td>
                                        <td>{{ $item['lokasi'] ?? 'Posyandu' }}</td>
                                        <td>
                                            <a href="{{ route('pemeriksaan.show', ['jenis' => $item['jenis_pemeriksaan'], 'pemeriksaan' => $item['id']]) }}"
                                                class="badge bg-primary text-decoration-none">
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data pemeriksaan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const chartData = @json($chartData);
    </script>
@endsection
