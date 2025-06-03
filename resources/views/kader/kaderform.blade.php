@extends('layouts.app')
@section('main')
    <section class="mt-0 mb-10">
        <div class="mx-auto max-w-screen-xl ">
            <!-- Start coding here -->
            <div class="bg-white dark:bg-white relative shadow-md sm:rounded-lg overflow-hidden">

                <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
                    <div class="card-body px-4 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">
                                <h4 class="fw-semibold mb-8">{{ $title }}</h4>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a class="text-muted text-decoration-none"
                                                href="{{ route('dashboard') }}">Home</a>
                                        </li>
                                        <li class="breadcrumb-item" aria-current="page">Ibu Hamil</li>
                                    </ol>
                                </nav>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card card-body border ">
                    <form action="{{ $action_form }}" method="post">
                        @csrf
                        @method($method)
                        <div class=" d-flex flex-column gap-3">

                            <div class="">
                                {{-- NIK --}}
                                <label for="nik" class="form-label">NIK <span class="text-danger">*</span></label>
                                <input type="number" id="nik" name="nik" placeholder="Masukkan NIK"
                                    value="{{ old('nik', $anggota->nik) }}" class="form-control">
                                @error('nik')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="">
                                {{-- Nama --}}
                                <label for="nama" class="form-label">Nama Lengkap <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="nama" name="nama" placeholder="Nama Kader"
                                    value="{{ old('nama', $anggota->nama) }}" class="form-control">
                                @error('nama')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="">
                                <label for="role" class="form-label">Role</label>
                                <select id="role" name="role" class="form-control">
                                    <option value="">Pilih</option>
                                    <option value="ibu_hamil"
                                        {{ old('role', $anggota->role ?? '') == 'ibu_hamil' ? 'selected' : '' }}>
                                        Ibu Hamil</option>
                                    <option value="kader"
                                        {{ old('role', $anggota->role ?? '') == 'kader' ? 'selected' : '' }}>
                                        Kader</option>
                                    <option value="ibu_hamil_kader"
                                        {{ old('role', $anggota->role ?? '') == 'ibu_hamil_kader' ? 'selected' : '' }}>
                                        Ibu Hamil dan Kader</option>
                                </select>
                                @error('role')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            {{-- Tanggal Lahir & Jenis Kelamin --}}
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <label for="tanggal-lahir" class="form-label">Tanggal Lahir <span
                                            class="text-danger">*</span></label>
                                    <input type="date" id="tanggal-lahir" name="tanggal_lahir"
                                        value="{{ old('tanggal_lahir', $anggota->tanggal_lahir) }}" class="form-control">
                                    @error('tanggal_lahir')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>


                                <div class="">
                                    {{-- Tempat Lahir --}}
                                    <label for="tempat-lahir" class="form-label">Tempat Lahir</label>
                                    <input type="text" id="tempat-lahir" name="tempat_lahir" placeholder="Tempat Lahir"
                                        value="{{ old('tempat_lahir', $anggota->tempat_lahir) }}" class="form-control">
                                    @error('tempat_lahir')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="">
                                    {{-- Pekerjaan --}}
                                    <label for="pekerjaan" class="form-label">Pekerjaan <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan"
                                        value="{{ old('pekerjaan', $anggota->pekerjaan) }}" class="form-control">
                                    @error('pekerjaan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="">

                                    {{-- Nomor Telepon --}}
                                    <label for="phone-number" class="form-label">Phone number <span
                                            class="text-danger">*</span></label>
                                    <input type="tel" id="phone-number" name="no_telepon" placeholder="Phone Number"
                                        value="{{ old('no_telepon', $anggota->no_telepon) }}" class="form-control">
                                    @error('no_telepon')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3 position-relative">
                                    <label for="posyandu_select" class="form-label">Pilih Posyandu</label>
                                    <select name="posyandu_id" id="posyandu_select" class="form-select"
                                        onchange="togglePosyanduInput(this)">
                                        <option value="">-- Pilih Posyandu --</option>
                                        @foreach ($posyandus as $pos)
                                            <option value="{{ $pos->id }}"
                                                {{ old('posyandu_id', $anggota->posyandu_id ?? '') == $pos->id ? 'selected' : '' }}>
                                                {{ $pos->nama }}
                                            </option>
                                        @endforeach
                                        <option value="lainnya"
                                            {{ old('posyandu_id', $anggota->posyandu_id ?? '') === 'lainnya' ? 'selected' : '' }}>
                                            Lainnya...
                                        </option>
                                    </select>

                                    <input type="text" name="posyandu_baru" class="form-control mt-2 d-none"
                                        id="posyandu_manual_input" placeholder="Masukkan nama posyandu baru"
                                        value="{{ old('posyandu_baru') }}">
                                </div>

                                <div class="">
                                    {{-- Alamat --}}
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text" id="alamat" name="alamat" placeholder="Masukkan Alamat"
                                        value="{{ old('alamat', $anggota->alamat) }}" class="form-control">
                                    @error('alamat')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                @if ($method === 'PUT')
                                    <div class="">
                                        <label for="status" class="form-label">Status Pengguna</label>
                                        <div class="w-full">
                                            <select id="status" name="status" class="form-control">
                                                <option value="1"
                                                    {{ old('aktif', $anggota->aktif) == 1 ? 'selected' : '' }}>Aktif
                                                </option>
                                                <option value="0"
                                                    {{ old('aktif', $anggota->aktif) == 0 ? 'selected' : '' }}>Nonaktif
                                                </option>
                                            </select>
                                            @error('status')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                            </div>
                            {{-- Tombol Aksi --}}
                            <div class="flex justify-between gap-4 mt-5 ">
                                <a href="{{ route('anggota.index') }}" class="btn btn-danger px-5">
                                    Batal
                                </a>
                                <button type="submit" class="btn btn-primary ms-2 px-5">
                                    Simpan
                                </button>
                            </div>
                            @if (old('riwayat') && count(old('riwayat')) > 0)
                                @php
                                    $riwayatData = old('riwayat');
                                @endphp
                            @elseif(isset($riwayat) && count($riwayat) > 0)
                                @php
                                    $riwayatData = $riwayat;
                                @endphp
                            @else
                                @php
                                    $riwayatData = null;
                                @endphp
                            @endif

                            @if ($riwayatData)
                                <div class="mt-4">
                                    <label class="form-label">Riwayat Kehamilan</label>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Tahun</th>
                                                <th>Berat Badan Bayi (kg)</th>
                                                <th>Proses Melahirkan</th>
                                                <th>Penolong</th>
                                                <th>Masalah</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="riwayat-table-body">
                                            @foreach ($riwayatData as $index => $item)
                                                <tr>
                                                    <td>
                                                        <input type="hidden" name="riwayat[{{ $index }}][id]"
                                                            value="{{ $item['id'] ?? ($item->id ?? '') }}">
                                                        <input type="text" name="riwayat[{{ $index }}][tahun]"
                                                            value="{{ $item['tahun'] ?? ($item->tahun ?? '') }}"
                                                            class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="text"
                                                            name="riwayat[{{ $index }}][berat_badan_bayi]"
                                                            value="{{ $item['berat_badan_bayi'] ?? ($item->berat_badan_bayi ?? '') }}"
                                                            class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="text"
                                                            name="riwayat[{{ $index }}][proses_melahirkan]"
                                                            value="{{ $item['proses_melahirkan'] ?? ($item->proses_melahirkan ?? '') }}"
                                                            class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="text"
                                                            name="riwayat[{{ $index }}][penolong]"
                                                            value="{{ $item['penolong'] ?? ($item->penolong ?? '') }}"
                                                            class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="text"
                                                            name="riwayat[{{ $index }}][masalah]"
                                                            value="{{ $item['masalah'] ?? ($item->masalah ?? '') }}"
                                                            class="form-control">
                                                    </td>
                                                    <td>
                                                        <select name="riwayat[{{ $index }}][status]"
                                                            class="form-control">
                                                            <option value="dalam_pemantauan"
                                                                {{ ($item['status'] ?? ($item->status ?? '')) == 'dalam_pemantauan' ? 'selected' : '' }}>
                                                                Dalam Pemantauan</option>
                                                            <option value="keguguran"
                                                                {{ ($item['status'] ?? ($item->status ?? '')) == 'keguguran' ? 'selected' : '' }}>
                                                                Keguguran</option>
                                                            <option value="berhasil"
                                                                {{ ($item['status'] ?? ($item->status ?? '')) == 'berhasil' ? 'selected' : '' }}>
                                                                Berhasil</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary btn-sm"
                                                            onclick="toggleEditSimpan(this, {{ $item['id'] ?? ($item->id ?? 'null') }})">Edit</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        function toggleEditSimpan(button, id) {
            const row = button.closest('tr');
            const inputs = row.querySelectorAll('input[type="text"]');
            const isReadonly = inputs[0].hasAttribute('readonly');

            const route = `{{ route('pemeriksaan.update', ':id') }}`.replace(':id', id);

            if (isReadonly) {
                // Ganti ke mode edit
                inputs.forEach(input => input.removeAttribute('readonly'));
                button.textContent = 'Simpan';
                button.classList.remove('btn-primary');
                button.classList.add('btn-success');
            } else {
                // Kumpulkan data untuk disimpan
                const data = {};
                inputs.forEach(input => {
                    const match = input.name.match(/\[(\w+)\]$/);
                    if (match) {
                        data[match[1]] = input.value;
                    }

                    const select = row.querySelector('select[name$="[status]"]');
                    if (select) {
                        const match = select.name.match(/\[(\w+)\]$/);
                        if (match) {
                            data[match[1]] = select.value;
                        }
                    }
                });
                console.log(data);
                fetch(route, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(data)
                    })
                    .then(async response => {
                        const resData = await response.json().catch(() => null);
                        if (response.ok && resData?.success) {
                            // Berhasil
                            inputs.forEach(input => input.setAttribute('readonly', true));
                            button.textContent = 'Edit';
                            button.classList.remove('btn-success');
                            button.classList.add('btn-primary');

                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: resData.message,
                                timer: 1500,
                                showConfirmButton: false
                            });
                        } else {
                            // Gagal dari server (misal validasi gagal)
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Gagal menyimpan data.'
                            });
                        }
                    })
                    .catch(error => {
                        console.error("Fetch error:", error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: 'Tidak dapat menghubungi server atau error parsing JSON.'
                        });
                    });
            }
        }
    </script>
    <script>
        function togglePosyanduInput(select) {
            const manualInput = document.getElementById('posyandu_manual_input');
            if (select.value === 'lainnya') {
                manualInput.classList.remove('d-none');
            } else {
                manualInput.classList.add('d-none');
            }
        }
    </script>
@endpush
