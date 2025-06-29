@extends('layouts.app')

@section('main')
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Edit Jadwal</h4>

                <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST" id="editjadwalForm">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" name="judul" id="judul" class="form-control"
                            value="{{ old('judul', $jadwal->judul) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="lokasi" class="form-label">Pilih Posyandu</label>
                        <select name="lokasi" id="lokasi" class="form-select" required>
                            <option value="">-- Pilih Posyandu --</option>
                            @foreach ($posyandu as $pos)
                                <option value="{{ $pos->id }}"
                                    {{ old('lokasi', $jadwal->lokasi ?? '') == $pos->id ? 'selected' : '' }}>
                                    {{ $pos->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="jam_mulai" class="form-label">Jam Mulai</label>
                            <input type="time" name="jam_mulai" id="jam_mulai" class="form-control"
                                value="{{ old('jam_mulai', $jadwal->jam_mulai) }}" required>
                        </div>
                        <div class="col">
                            <label for="jam_selesai" class="form-label">Jam Selesai</label>
                            <input type="time" name="jam_selesai" id="jam_selesai" class="form-control"
                                value="{{ old('jam_selesai', $jadwal->jam_selesai) }}" required>
                            <div class="invalid-feedback" id="jam_selesai_error"></div>
                        </div>
                        <div class="col">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control"
                                value="{{ old('tanggal', $jadwal->tanggal) }}" required>
                            <div class="invalid-feedback" id="tanggal_error"></div>
                        </div>
                    </div>

                    <!-- Pilih Anggota yang Hadir -->
                    <div class="mb-3">
                        <label class="form-label">Anggota yang Menghadiri</label>
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#anggotaModal">
                            Pilih Anggota
                        </button>
                        <div id="anggotaTerpilihLabel" class="mt-2 text-muted">Memuat data anggota...</div>
                        <div id="anggotaHiddenInputs"></div>
                    </div>

                    <div class="flex justify-between gap-4 mt-5">
                        <a href="{{ route('jadwal.index') }}" class="btn btn-danger px-5">Batal</a>
                        <button type="submit" class="btn btn-primary ms-2 px-5">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Anggota -->
    <div class="modal fade" id="anggotaModal" tabindex="-1" aria-labelledby="anggotaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pilih Anggota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <!-- Filter Posyandu -->
                    <div class="mb-3">
                        <label>Filter Posyandu</label>
                        <select id="filterPosyanduModal" class="form-select">
                            <option value="semua">-- Semua Posyandu --</option>
                            @foreach ($posyandu as $pos)
                                <option value="{{ $pos->id }}">{{ $pos->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tombol Pilih Semua / Batal -->
                    <div class="mb-3 d-flex justify-content-between">
                        <button type="button" class="btn btn-sm btn-success" id="pilihSemuaBtn">Pilih Semua
                            Anggota</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary" id="batalPilihSemuaBtn">Batal Pilih
                            Semua</button>
                    </div>

                    <!-- Pencarian -->
                    <div class="mb-3">
                        <label>Cari Nama atau NIK</label>
                        <input type="text" id="searchAnggota" class="form-control" placeholder="Ketik nama atau NIK...">
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
                    <button type="button" class="btn btn-primary" id="simpanAnggotaBtn" data-bs-dismiss="modal">Simpan
                        Pilihan</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jamMulai = document.getElementById('jam_mulai');
            const jamSelesai = document.getElementById('jam_selesai');
            const tanggal = document.getElementById('tanggal');
            const anggotaTerpilihLabel = document.getElementById('anggotaTerpilihLabel');
            const anggotaHiddenInputs = document.getElementById('anggotaHiddenInputs');
            const anggotaCheckboxes = document.querySelectorAll('.anggota-checkbox');
            const anggotaDipilih = @json(old('yang_menghadiri', $jadwal->yang_menghadiri ?? []));

            // Set tanggal minimum hari ini
            const today = new Date().toISOString().split('T')[0];
            tanggal.setAttribute('min', today);

            // Validasi waktu
            function validateTime() {
                const start = jamMulai.value;
                const end = jamSelesai.value;
                if (start && end && end <= start) {
                    jamSelesai.classList.add('is-invalid');
                    document.getElementById('jam_selesai_error').textContent =
                        'Jam selesai harus lebih dari jam mulai';
                    return false;
                }
                jamSelesai.classList.remove('is-invalid');
                document.getElementById('jam_selesai_error').textContent = '';
                return true;
            }

            // Validasi tanggal
            function validateDate() {
                const selected = tanggal.value;
                if (selected && selected < today) {
                    tanggal.classList.add('is-invalid');
                    document.getElementById('tanggal_error').textContent =
                        'Tanggal tidak boleh kurang dari hari ini';
                    return false;
                }
                tanggal.classList.remove('is-invalid');
                document.getElementById('tanggal_error').textContent = '';
                return true;
            }


            function updateAnggotaTerpilih() {
                const checked = Array.from(anggotaCheckboxes).filter(cb => cb.checked);
                anggotaHiddenInputs.innerHTML = '';
                if (checked.length === 0) {
                    anggotaTerpilihLabel.innerText = 'Belum ada anggota dipilih';
                } else {
                    checked.forEach(cb => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'yang_menghadiri[]';
                        input.value = cb.value;
                        anggotaHiddenInputs.appendChild(input);
                    });
                    anggotaTerpilihLabel.innerText = `${checked.length} anggota dipilih`;
                }
            }

            anggotaCheckboxes.forEach(cb => {
                cb.checked = anggotaDipilih.includes(parseInt(cb.value));
            });
            updateAnggotaTerpilih();

            document.getElementById('simpanAnggotaBtn').addEventListener('click', updateAnggotaTerpilih);

            document.getElementById('pilihSemuaBtn').addEventListener('click', function() {
                const selectedPos = document.getElementById('filterPosyanduModal').value;
                document.querySelectorAll('.anggota-item').forEach(item => {
                    const posId = item.getAttribute('data-posyandu');
                    if ((selectedPos === 'semua' || posId === selectedPos) && item.style.display !==
                        'none') {
                        item.querySelector('input').checked = true;
                    }
                });
                updateAnggotaTerpilih();
            });

            // Tombol batal pilih semua (hapus semua centang)
            document.getElementById('batalPilihSemuaBtn').addEventListener('click', function() {
                document.querySelectorAll('.anggota-checkbox').forEach(cb => cb.checked = false);
                updateAnggotaTerpilih();
            });

            // Filter list anggota berdasar posyandu dan pencarian
            document.getElementById('filterPosyanduModal').addEventListener('change', filterAnggota);
            document.getElementById('searchAnggota').addEventListener('input', filterAnggota);

            function filterAnggota() {
                const selectedPos = document.getElementById('filterPosyanduModal').value;
                const search = document.getElementById('searchAnggota').value.toLowerCase();
                document.querySelectorAll('.anggota-item').forEach(item => {
                    const posId = item.getAttribute('data-posyandu');
                    const label = item.textContent.toLowerCase();
                    const match = (selectedPos === 'semua' || posId === selectedPos) && label.includes(
                        search);
                    item.style.display = match ? 'block' : 'none';
                });
            }

            // Validasi form sebelum submit
            document.getElementById('editjadwalForm').addEventListener('submit', function(e) {
                const validTime = validateTime();
                const validDate = validateDate();
                const anggotaSelectedCount = document.querySelectorAll('#anggotaHiddenInputs input').length;

                if (!validTime || !validDate || anggotaSelectedCount === 0) {
                    e.preventDefault();
                    alert('Mohon lengkapi form dengan benar dan pilih minimal 1 anggota.');
                }
            });

            // Jalankan validasi awal
            validateTime();
            validateDate();
        });
    </script>
@endsection
