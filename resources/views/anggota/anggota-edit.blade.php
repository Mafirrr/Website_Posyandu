<x-app-layout>
    <section class="mt-5 mb-10">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <h2 class="text-2xl font-semibold mb-5">Update Ibu Hamil</h2>

            <div class="bg-gray-100 rounded-xl shadow-lg w-full p-10 relative">
                <form action="{{ route('anggota.update', $anggota->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- NIK --}}
                    <label for="nik" class="block mb-1 font-bold">NIK <span class="text-red-500">*</span></label>
                    <input type="text" id="nik" name="nik" value="{{ old('nik', $anggota->nik) }}"
                        class="w-full p-2 border border-gray-300 rounded-md mb-1">
                    @error('nik')
                        <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
                    @enderror

                    {{-- Nama --}}
                    <label for="nama" class="block mb-1 font-bold">Nama Lengkap <span
                            class="text-red-500">*</span></label>
                    <input type="text" id="nama" name="nama" placeholder="Nama Ibu Hamil"
                        value="{{ old('nama', $anggota->nama) }}"
                        class="w-full p-2 border border-gray-300 rounded-md mb-1">
                    @error('nama')
                        <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
                    @enderror

                    {{-- Tanggal Lahir & Jenis Kelamin --}}
                    <div class="flex justify-between gap-4">
                        <div class="w-1/2">
                            <label for="tanggal-lahir" class="block mb-1 font-bold">Tanggal Lahir <span
                                    class="text-red-500">*</span></label>
                            <input type="date" id="tanggal-lahir" name="tanggal_lahir"
                                value="{{ old('tanggal_lahir', $anggota->tanggal_lahir) }}"
                                class="w-full p-2 border border-gray-300 rounded-md mb-1">
                            @error('tanggal_lahir')
                                <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-1/2">
                            <label for="jenis-kelamin" class="block mb-1 font-bold">Golongan Darah</label>
                            <select id="golongan_darah" name="golongan_darah"
                                class="w-full p-2 border border-gray-300 rounded-md mb-1">
                                <option value="">Pilih</option>
                                <option value="A-" {{ old('golongan_darah', $anggota->golongan_darah ?? '') == 'A-' ? 'selected' : '' }}>A-</option>
                                <option value="A+" {{ old('golongan_darah', $anggota->golongan_darah ?? '') == 'A+' ? 'selected' : '' }}>A+</option>
                                <option value="B-" {{ old('golongan_darah', $anggota->golongan_darah ?? '') == 'B-' ? 'selected' : '' }}>B-</option>
                                <option value="B+" {{ old('golongan_darah', $anggota->golongan_darah ?? '') == 'B+' ? 'selected' : '' }}>B+</option>
                                <option
                                    value="AB- {{ old('golongan_darah', $anggota->golongan_darah ?? '') == 'AB-' ? 'selected' : '' }}">
                                    AB-</option>
                                <option
                                    value="AB+ {{ old('golongan_darah', $anggota->golongan_darah ?? '') == 'AB+' ? 'selected' : '' }}">
                                    AB+</option>
                                <option value="O-" {{ old('golongan_darah', $anggota->golongan_darah ?? '') == 'O-' ? 'selected' : '' }}>O-</option>
                                <option value="O+" {{ old('golongan_darah', $anggota->golongan_darah ?? '') == 'O-' ? 'selected' : '' }}>O+</option>
                            </select>
                            @error('golongan_darah')
                                <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Tempat Lahir --}}
                    <label for="tempat-lahir" class="block mb-1 font-bold">Tempat Lahir</label>
                    <input type="text" id="tempat-lahir" name="tempat_lahir" placeholder="Tempat Lahir"
                        value="{{ old('tempat_lahir', $anggota->tempat_lahir) }}"
                        class="w-full p-2 border border-gray-300 rounded-md mb-1">
                    @error('tempat_lahir')
                        <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
                    @enderror

                    {{-- Pekerjaan --}}
                    <label for="pekerjaan" class="block mb-1 font-bold">Pekerjaan <span
                            class="text-red-500">*</span></label>
                    <input type="text" id="pekerjaan" name="pekerjaan"
                        value="{{ old('pekerjaan', $anggota->pekerjaan) }}"
                        class="w-full p-2 border border-gray-300 rounded-md mb-1">
                    @error('pekerjaan')
                        <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
                    @enderror

                    {{-- Nomor Telepon --}}
                    <label for="phone-number" class="block mb-1 font-bold">Phone number <span
                            class="text-red-500">*</span></label>
                    <input type="text" id="phone-number" name="no_telepon" placeholder="Phone Number"
                        value="{{ old('no_telepon', $anggota->no_telepon) }}"
                        class="w-full p-2 border border-gray-300 rounded-md mb-1">
                    @error('no_telepon')
                        <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
                    @enderror

                    {{-- Alamat --}}
                    <label for="alamat" class="block mb-1 font-bold">Alamat</label>
                    <input type="text" id="alamat" name="alamat" placeholder="Alamat"
                        value="{{ old('alamat', $anggota->alamat) }}"
                        class="w-full p-2 border border-gray-300 rounded-md mb-1">
                    @error('alamat')
                        <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
                    @enderror

                    {{-- Tombol Aksi --}}
                    <div class="flex justify-between gap-4 mt-6">
                        <a href="{{ route('anggota.index') }}"
                            class="w-1/2 py-2 text-center border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">
                            Batal
                        </a>
                        <button type="submit"
                            class="w-1/2 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>