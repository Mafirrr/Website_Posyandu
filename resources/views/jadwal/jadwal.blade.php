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

                        <div class="mb-3 d-flex justify-content-between">
                            <button type="button" class="btn btn-sm btn-success" id="pilihSemuaBtn">
                                Pilih Semua Anggota
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" id="batalPilihSemuaBtn">
                                Batal Pilih Semua
                            </button>
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
            const anggotaHiddenInputs = document.getElementById('anggotaHiddenInputs');
            const anggotaTerpilihLabel = document.getElementById('anggotaTerpilihLabel');
            const anggotaCheckboxes = document.querySelectorAll('.anggota-checkbox');

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

            form.addEventListener('submit', function(e) {
                const anggotaTerpilih = document.querySelectorAll('#anggotaHiddenInputs input');

                if (anggotaTerpilih.length === 0) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Anggota Belum Dipilih!',
                        html: '<div style="text-align: center;"><strong>Silakan pilih minimal 1 anggota yang akan menghadiri.</strong><br></div>',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#3085d6'
                    });
                    return;
                }

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

            // Fungsi update hidden input dan label anggota terpilih
            function updateAnggotaTerpilih() {
                const checkedBoxes = document.querySelectorAll('.anggota-checkbox:checked');
                anggotaHiddenInputs.innerHTML = '';

                if (checkedBoxes.length === 0) {
                    anggotaTerpilihLabel.innerText = 'Belum ada anggota dipilih';
                    return;
                }

                checkedBoxes.forEach(cb => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'yang_menghadiri[]';
                    input.value = cb.value;
                    anggotaHiddenInputs.appendChild(input);
                });

                anggotaTerpilihLabel.innerText = `${checkedBoxes.length} anggota dipilih`;
            }

            // Filter dan pencarian anggota
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
                        // Jangan otomatis uncheck jika tidak tampil supaya bisa tetap menambah anggota
                        // item.querySelector('input').checked = false; // Jangan pakai ini kalau ingin tambah anggota
                    }
                });
            }

            document.getElementById('searchAnggota').addEventListener('input', filterAnggota);
            document.getElementById('filterPosyanduModal').addEventListener('change', filterAnggota);

            // Tombol simpan anggota (simpan pilihan modal ke hidden input)
            document.getElementById('simpanAnggotaBtn').addEventListener('click', updateAnggotaTerpilih);

            // Tombol bersihkan semua pilihan
            document.getElementById('clearAnggotaBtn').addEventListener('click', function() {
                document.querySelectorAll('.anggota-checkbox').forEach(cb => cb.checked = false);
                anggotaHiddenInputs.innerHTML = '';
                anggotaTerpilihLabel.innerText = 'Belum ada anggota dipilih';
            });

            // Tombol pilih semua berdasarkan filter (menambah anggota yang belum dicek)
            document.getElementById('pilihSemuaBtn').addEventListener('click', function() {
                const selectedPos = document.getElementById('filterPosyanduModal').value;

                document.querySelectorAll('.anggota-item').forEach(item => {
                    const posId = item.getAttribute('data-posyandu');
                    const checkbox = item.querySelector('input');

                    if ((selectedPos === 'semua' || posId === selectedPos) && item.style.display !==
                        'none' && !checkbox.checked) {
                        checkbox.checked = true; // hanya tambah yang belum dicek
                    }
                });

                updateAnggotaTerpilih();
            });

            // Tombol batal pilih semua (membatalkan semua pilihan di modal)
            document.getElementById('batalPilihSemuaBtn').addEventListener('click', function() {
                document.querySelectorAll('.anggota-checkbox').forEach(cb => cb.checked = false);
                updateAnggotaTerpilih();
            });

            // Sinkronisasi ketika modal dibuka (checkbox sync dengan hidden inputs)
            var anggotaModal = document.getElementById('anggotaModal');
            anggotaModal.addEventListener('show.bs.modal', function() {
                document.getElementById('filterPosyanduModal').value = 'semua';
                document.getElementById('searchAnggota').value = '';
                filterAnggota();

                const selectedValues = Array.from(document.querySelectorAll('#anggotaHiddenInputs input'))
                    .map(input => input.value);

                document.querySelectorAll('.anggota-checkbox').forEach(cb => {
                    cb.checked = selectedValues.includes(cb.value);
                });
            });
        });
    </script>
@endsection
