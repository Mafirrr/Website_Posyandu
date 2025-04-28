<x-app-layout>
    <section class="mt-5 mb-10">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <h2 class="text-2xl font-semibold mb-5">Tambah Berita</h2>
            <div class="bg-gray-100 rounded-xl shadow-lg w-full p-10 relative">
                <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <form action="/berita" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="gambar" class="block mb-1 font-bold">Thumbnail <span class="text-red-500">*</span></label>
                        <input type="file" id="gambar" name="gambar"
                            class="w-full p-2 border rounded-md mb-5 @error('thumbnail') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 @enderror">

                        <!-- Input Slug -->
                        <label for="slug" class="block mb-1 font-bold">Slug <span class="text-red-500">*</span></label>
                        <input type="text" id="slug" name="slug" placeholder="Slug Berita"
                            class="w-full p-2 border rounded-md mb-5 @error('slug') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 @enderror"
                            value="{{ old('slug') }}">
                        @error('slug')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror

                        <!-- Input Title -->
                        <label for="judul" class="block mb-1 font-bold">Title <span class="text-red-500">*</span></label>
                        <input type="text" id="judul" name="judul" placeholder="Judul Berita"
                            class="w-full p-2 border rounded-md mb-5 @error('judul') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 @enderror"
                            value="{{ old('judul') }}">
                        @error('judul')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror

                        <!-- Input Deskripsi -->
                        <label for="isi" class="block mb-1 font-bold">Deskripsi <span class="text-red-500">*</span></label>
                        <textarea id="isi" name="isi" rows="4" placeholder="Deskripsi Berita"
                            class="w-full p-2 border rounded-md mb-5 @error('isi') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 @enderror">{{ old('isi') }}</textarea>
                        @error('isi')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror

                        <!-- Input Kategori -->
                        <label for="kategori" class="block mb-1 font-bold">Kategori <span class="text-red-500">*</span></label>
                        <select id="kategori" name="kategori_id"
                            class="w-full p-2 border rounded-md mb-5 @error('kategori_id') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 @enderror">
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror

                        <!-- Input Tanggal -->
                        <label for="tanggal" class="block mb-1 font-bold">Tanggal <span class="text-red-500">*</span></label>
                        <input type="date" id="tanggal" name="tanggal"
                            class="w-full p-2 border rounded-md mb-6 @error('tanggal') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 @enderror"
                            value="{{ old('tanggal') }}">
                        @error('tanggal')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror

                    <div class="flex justify-between gap-4">
                        <a href="{{ route('berita.index') }}"
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
