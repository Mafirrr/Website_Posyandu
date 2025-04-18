<x-app-layout>
    <section class="mt-5 mb-10">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <h2 class="text-2xl font-semibold mb-5">Tambah Ibu Hamil</h2>
            <div class="bg-gray-100 rounded-xl shadow-lg w-full p-10 relative">
                <form action="{{ route('anggota.store') }}" method="POST">
                    @csrf
                    <label for="nik" class="block mb-1 font-bold">NIK <span class="text-red-500">*</span></label>
                    <input type="text" id="nik" name="nik" placeholder="Nomor Induk Kependudukan"
                        class="w-full p-2 border rounded-md mb-5 @error('nik') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 @enderror"
                        value="{{ old('nik') }}">

                    <label for="password" class="block mb-1 font-bold">Password <span
                            class="text-red-500">*</span></label>
                    <input type="password" id="password" name="password" placeholder="Password"
                        class="w-full p-2 border rounded-md mb-5 @error('password') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 @enderror"
                        value="{{ old('password') }}">

                    <label for="nama" class="block mb-1 font-bold">Nama Lengkap <span
                            class="text-red-500">*</span></label>
                    <input type="text" id="nama" name="nama" placeholder="Nama Ibu Hamil"
                        class="w-full p-2 border rounded-md mb-5 @error('nama') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 @enderror"
                        value="{{ old('nama') }}">

                    <div class="flex justify-between gap-4">
                        <div class="w-1/2">
                            <label for="tanggal_lahir" class="block mb-1 font-bold">Tanggal Lahir <span
                                    class="text-red-500">*</span></label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                                class="w-full p-2 border rounded-md mb-5 @error('tanggal_lahir') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 @enderror"
                        value="{{ old('tanggal_lahir') }}">
                        </div>
                        <div class="w-1/2">
                            <label for="golongan_darah" class="block mb-1 font-bold">Golongan Darah</label>
                            <select id="golongan_darah" name="golongan_darah"
                                class="w-full p-2 border rounded-md mb-5 @error('golongan_darah') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 @enderror"
                        value="{{ old('golongan_darah') }}">
                                <option value="">Pilih</option>
                                <option value="A-">A-</option>
                                <option value="A+">A+</option>
                                <option value="B-">B-</option>
                                <option value="B+">B+</option>
                                <option value="AB-">AB-</option>
                                <option value="AB+">AB+</option>
                                <option value="O-">O-</option>
                                <option value="O+">O+</option>
                            </select>
                        </div>
                    </div>

                    <label for="tempat_lahir" class="block mb-1 font-bold">Tempat Lahir</label>
                    <input type="text" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir"
                        class="w-full p-2 border rounded-md mb-5 @error('tempat_lahir') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 @enderror"
                        value="{{ old('tempat_lahir') }}">

                    <label for="pekerjaan" class="block mb-1 font-bold">Pekerjaan</label>
                    <input type="text" id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan"
                        class="w-full p-2 border rounded-md mb-5 @error('pekerjaan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 @enderror"
                        value="{{ old('pekerjaan') }}">

                    <label for="no_telepon" class="block mb-1 font-bold">No. Telepon</label>
                    <input type="text" id="no_telepon" name="no_telepon" placeholder="Phone Number"
                        class="w-full p-2 border rounded-md mb-5 @error('no_telepon') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 @enderror"
                        value="{{ old('no_telepon') }}">

                    <label for="alamat" class="block mb-1 font-bold">Alamat</label>
                    <input type="text" id="alamat" name="alamat" placeholder="Alamat"
                        class="w-full p-2 border rounded-md mb-6 @error('alamat') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 @enderror"
                        value="{{ old('alamat') }}">

                    <div class="flex justify-between gap-4">
                        <a href="{{ route('anggota.index') }}"
                            class="w-1/2 py-2 text-center border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">
                            Batal
                        </a>
                        <button type="submit"
                            class="w-1/2 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>