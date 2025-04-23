<x-app-layout>
    <section class="mt-5 mb-10">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <h2 class="text-2xl font-semibold mb-5">Tambah Berita</h2>
            <div class="bg-gray-100 rounded-xl shadow-lg w-full p-10 relative">
                <form action="{{ route('berita.tambah') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <label for="thumbnail" class="block mb-1 font-bold">Thumbnail <span class="text-red-500">*</span></label>
                    <input type="file" id="thumbnail" name="thumbnail"
                        class="w-full p-2 border rounded-md mb-5 @error('thumbnail') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 @enderror">

                    <label for="title" class="block mb-1 font-bold">Title <span class="text-red-500">*</span></label>
                    <input type="text" id="title" name="title" placeholder="Judul Berita"
                        class="w-full p-2 border rounded-md mb-5 @error('title') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 @enderror"
                        value="{{ old('title') }}">

                    <label for="deskripsi" class="block mb-1 font-bold">Deskripsi <span class="text-red-500">*</span></label>
                    <textarea id="deskripsi" name="deskripsi" rows="4" placeholder="Deskripsi Berita"
                        class="w-full p-2 border rounded-md mb-5 @error('deskripsi') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 @enderror">{{ old('deskripsi') }}</textarea>

                    <label for="kategori" class="block mb-1 font-bold">Kategori <span class="text-red-500">*</span></label>
                    <select id="kategori" name="kategori"
                        class="w-full p-2 border rounded-md mb-5 @error('kategori') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 @enderror">
                        <option value="">Pilih Kategori</option>
                        <option value="Politik">makanan sehat</option>
                        <option value="Ekonomi">pola hidup</option>
                        <option value="Sosial">olahraga</option>
                        <option value="Teknologi">kesehatan diri dan mental</option>
                        <option value="Teknologi">tanda tanda kehamilan</option>
                    </select>

                    <label for="tanggal" class="block mb-1 font-bold">Tanggal <span class="text-red-500">*</span></label>
                    <input type="date" id="tanggal" name="tanggal"
                        class="w-full p-2 border rounded-md mb-6 @error('tanggal') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 @enderror"
                        value="{{ old('tanggal') }}">

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
