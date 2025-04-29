@extends("layouts.app")

@section("main")
<div class="row">

    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Grafik Kehamilan</h5>
                    </div>
                    <div>
                        <select class="form-select w-auto" id="dataSelector">
                            <option value="line_1">Banyak Pengunjung</option>
                            <option value="line_2">Entahlah</option>
                        </select>
                    </div>
                </div>
                <div id="chart"></div>
            </div>
        </div>
    </div>


    <!-- Riwayat Pemeriksaan -->
    <div class="col-lg-12">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="card-title fw-semibold">Riwayat Pemeriksaan</h5>
                    <select class="form-select w-auto">
                        <option>Oktober</option>
                    </select>
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
                            <tr>
                                <td>Susi Astuti</td>
                                <td>Trimester 1</td>
                                <td>14-05-2025</td>
                                <td>12.00</td>
                                <td>Posyandu</td>
                                <td><span class="badge bg-primary">Selesai</span></td>
                            </tr>
                            <tr>
                                <td>Rini Rani</td>
                                <td>Trimester 3</td>
                                <td>20-06-2025</td>
                                <td>09.00</td>
                                <td>Posyandu</td>
                                <td><span class="badge bg-warning text-dark">Proses</span></td>
                            </tr>
                            <tr>
                                <td>Rini Rani</td>
                                <td>Trimester 3</td>
                                <td>20-06-2025</td>
                                <td>09.00</td>
                                <td>Posyandu</td>
                                <td><span class="badge bg-warning text-dark">Proses</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

