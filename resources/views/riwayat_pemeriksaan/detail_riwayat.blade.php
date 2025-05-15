@extends('layouts.app')

@section('main')
    <div>
        <section class="mt-5 mb-10">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <div class="bg-white dark:bg-white relative shadow-md sm:rounded-lg overflow-hidden">

                    {{-- Breadcrumb --}}
                    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
                        <div class="card-body px-4 py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="fw-semibold mb-8">Pelayanan Posyandu</h4>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a class="text-muted text-decoration-none"
                                                    href="{{ route('riwayat.index') }}">
                                                    Riwayat Pemeriksaan
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item" aria-current="page">Detail Riwayat Pemeriksaan</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Detail Pemeriksaan --}}
                    <div class="card border">
                        <div class="card-body">
                            <h5 class="mt-4 mb-4">Detail Pemeriksaan</h5>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Jenis Pemeriksaan</th>
                                        <td>{{ $jenis }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Anggota</th>
                                        <td>{{ $namaAnggota }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <h5 class="mt-5 mb-3">Hasil Pemeriksaan:</h5>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Field</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pemeriksaan->toArray() as $key => $value)
                                            @php
                                                // Exclude keys yang tidak mau ditampilkan
                                                $excludedKeys = ['id','pemeriksaan_id', 'created_at', 'updated_at', 'deleted_at', 'kehamilan', 'pemeriksaanKehamilan', 'petugas_id', 'kehamilan_id', 'pemeriksaan'];

                                                // Jika value adalah array atau objek, exclude juga agar tidak tampil sebagai json panjang
                                                $isRelation = is_array($value) || is_object($value);
                                            @endphp

                                            @if (!in_array($key, $excludedKeys) && !$isRelation)
                                                <tr>
                                                    <td>{{ ucfirst(str_replace('_', ' ', $key)) }}</td>
                                                    <td>{{ $value }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <a href="{{ url()->previous() }}" class="btn btn-primary ms-2 px-5">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection