@extends('layouts.app')

@section('main')
    <div class="container mt-4">
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <h4 class="fw-semibold mb-8">Pelayanan Posyandu</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="#">Pelayanan
                                Posyandu</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Jadwal Posyandu</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Pembuatan Jadwal</h4>

                <form action="{{ route('jadwal.store') }}" method="POST" id="jadwalForm">
                    @csrf

                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" name="judul" id="judul" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="lokasi" class="form-label">Pilih Posyandu</label>
                        <select name="lokasi" id="lokasi" class="form-select" data-temp-required="true" required>
                            <option value="">-- Pilih Posyandu --</option>
                            @foreach ($posyandus as $pos)
                                <option value="{{ $pos->id }}">{{ $pos->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="jam_mulai" class="form-label">Jam Mulai</label>
                            <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" required>
                        </div>
                        <div class="col">
                            <label for="jam_selesai" class="form-label">Jam Selesai</label>
                            <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" required>
                            <div class="invalid-feedback" id="jam_selesai_error"></div>
                        </div>
                        <div class="col">
                            <label for="tanggal" class="form-label">Hari & Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" required
                                min="{{ date('Y-m-d') }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Anggota yang Menghadiri</label>
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#anggotaModal">
                            Pilih Anggota
                        </button>
                        <button type="button" class="btn btn-outline-danger ms-2" id="clearAnggotaBtn">
                            Bersihkan Pilihan
                        </button>
                        <div id="anggotaTerpilihLabel" class="mt-2 text-muted">Belum ada anggota dipilih</div>

                        <!-- Container input tersembunyi -->
                        <div id="anggotaHiddenInputs"></div>
                    </div>

                    <div class="flex justify-between gap-4 mt-5">
                        <button type="submit" class="btn btn-primary ms-2 px-5">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Pilih Anggota -->
        <div class="modal fade" id="anggotaModal" tabindex="-1" aria-labelledby="anggotaModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="anggotaModalLabel">Pilih Anggota</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Filter Posyandu -->
                        <div class="mb-3">
                            <label>Filter Posyandu</label>
                            <select id="filterPosyanduModal" class="form-select">
                                <option value="semua">-- Semua Posyandu --</option>
                                @foreach ($posyandus as $pos)
                                    <option value="{{ $pos->id }}">{{ $pos->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Pencarian -->
                        <div class="mb-3">
                            <label>Cari Nama atau NIK</label>
                            <input type="text" id="searchAnggota" class="form-control"
                                placeholder="Ketik nama atau NIK...">
                        </div>

                        <!-- Daftar Anggota -->
                        <div style="max-height: 300px; overflow-y: auto;" id="anggotaList">
                            @foreach ($anggota as $item)
                                <div class="form-check anggota-item" data-posyandu="{{ $item->posyandu_id }}">
                                    <input class="form-check-input anggota-checkbox" type="checkbox"
                                        value="{{ $item->id }}" id="anggotaModal_{{ $item->id }}">
                                    <label class="form-check-label" for="anggotaModal_{{ $item->id }}">
                                        {{ $item->nama }} ({{ $item->nik }})
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" id="simpanAnggotaBtn"
                            data-bs-dismiss="modal">Simpan Pilihan</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border mb-4">
            <div class="card-body">
                <h4 class="card-title mb-4">Daftar Jadwal</h4>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table search-table align-middle text-nowrap">
                        <thead class="header-item">
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Lokasi</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwals as $key => $jadwal)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $jadwal->judul }}</td>
                                    <td>{{ $jadwal->posyandu->nama }}</td>
                                    <td>{{ $jadwal->jam_mulai }}</td>
                                    <td>{{ $jadwal->jam_selesai }}</td>
                                    <td>{{ $jadwal->tanggal }}</td>
                                    <td>
                                        @if (\Carbon\Carbon::parse($jadwal->tanggal)->isFuture())
                                            <a href="{{ route('jadwal.edit', $jadwal->id) }}"
                                                class="btn btn-sm btn-warning" title="Edit">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                        @endif

                                        <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                <i class="ti ti-trash"></i>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jamMulai = document.getElementById('jam_mulai');
            const jamSelesai = document.getElementById('jam_selesai');
            const jamSelesaiError = document.getElementById('jam_selesai_error');
            const form = document.getElementById('jadwalForm');

            function validateTime() {
                if (jamMulai.value && jamSelesai.value) {
                    if (jamSelesai.value <= jamMulai.value) {
                        jamSelesai.classList.add('is-invalid');
                        jamSelesaiError.textContent = 'Jam selesai harus lebih dari jam mulai';
                        return false;
                    } else {
                        jamSelesai.classList.remove('is-invalid');
                        jamSelesaiError.textContent = '';
                        return true;
                    }
                }
                return true;
            }

            jamMulai.addEventListener('change', validateTime);
            jamSelesai.addEventListener('change', validateTime);

            form.addEventListener('submit', function(e) {
                if (!validateTime()) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Waktu Salah!',
                        html: '<div style="text-align: center;"><strong>Jam selesai harus lebih dari jam mulai</strong><br></div>',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#3085d6'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            jamSelesai.focus();
                        }
                    });
                }
            });

            const today = new Date().toISOString().split('T')[0];
            document.getElementById('tanggal').setAttribute('min', today);
        });

        // Sync checkbox with filter & search
        document.getElementById('searchAnggota').addEventListener('input', filterAnggota);
        document.getElementById('filterPosyanduModal').addEventListener('change', filterAnggota);

        function filterAnggota() {
            const selectedPos = document.getElementById('filterPosyanduModal').value;
            const keyword = document.getElementById('searchAnggota').value.toLowerCase();

            document.querySelectorAll('.anggota-item').forEach(item => {
                const posId = item.getAttribute('data-posyandu');
                const text = item.textContent.toLowerCase();

                const matchPos = (selectedPos === 'semua' || posId === selectedPos);
                const matchKeyword = text.includes(keyword);

                if (matchPos && matchKeyword) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                    item.querySelector('input').checked = false;
                }
            });
        }

        // Simpan anggota terpilih ke hidden input dan label
        document.getElementById('simpanAnggotaBtn').addEventListener('click', function() {
            const selectedCheckboxes = document.querySelectorAll('.anggota-checkbox:checked');
            const container = document.getElementById('anggotaHiddenInputs');
            const label = document.getElementById('anggotaTerpilihLabel');

            container.innerHTML = '';

            if (selectedCheckboxes.length === 0) {
                label.innerText = 'Belum ada anggota dipilih';
                return;
            }

            selectedCheckboxes.forEach(cb => {
                const hidden = document.createElement('input');
                hidden.type = 'hidden';
                hidden.name = 'yang_menghadiri[]';
                hidden.value = cb.value;
                container.appendChild(hidden);
            });

            label.innerText = selectedCheckboxes.length + ' anggota dipilih';
        });

        // Bersihkan pilihan anggota
        document.getElementById('clearAnggotaBtn').addEventListener('click', function() {
            document.querySelectorAll('.anggota-checkbox').forEach(cb => cb.checked = false);
            document.getElementById('anggotaHiddenInputs').innerHTML = '';
            document.getElementById('anggotaTerpilihLabel').innerText = 'Belum ada anggota dipilih';
        });

        // Saat modal dibuka, sinkronkan checkbox dengan hidden inputs yang sudah ada
        var anggotaModal = document.getElementById('anggotaModal');
        anggotaModal.addEventListener('show.bs.modal', function() {
            // Reset filter dan search
            document.getElementById('filterPosyanduModal').value = 'semua';
            document.getElementById('searchAnggota').value = '';
            filterAnggota();

            // Ambil nilai anggota yang sudah dipilih di hidden inputs
            const selectedValues = Array.from(document.querySelectorAll('#anggotaHiddenInputs input')).map(input =>
                input.value);

            // Sync checkbox
            document.querySelectorAll('.anggota-checkbox').forEach(cb => {
                cb.checked = selectedValues.includes(cb.value);
            });
        });
    </script>
@endsection
