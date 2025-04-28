<x-app-layout>
    <div>
        <div class="flex items-center justify-between m-5">
            <h2 class="text-2xl font-semibold">Data Berita</h2>
            <button type="button" onclick="window.location='{{ route('berita.tambah') }}'"
                class="py-2 px-4 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                Tambah Berita
            </button>
        </div>

        <section class="mt-5 mb-10">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <div class="bg-white dark:bg-white relative shadow-md sm:rounded-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-black dark:text-black">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                                <tr>
                                    <th scope="col" class="px-4 py-3">NO.</th>
                                    <th scope="col" class="px-4 py-3">Thumbnail</th>
                                    <th scope="col" class="px-4 py-3">Title</th>
                                    <th scope="col" class="px-4 py-3">Deskripsi</th>
                                    <th scope="col" class="px-4 py-3">Kategori</th>
                                    <th scope="col" class="px-4 py-3">Date</th>
                                    <th scope="col" class="px-4 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($beritas as $berita)
                                    <tr class="border-b dark:border-gray-500">
                                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                                            {{ $loop->iteration }}
                                        </th>
                                        <td class="px-4 py-3">
                                            <img src="storage/{{ $berita->gambar }}" alt="Thumbnail" class="w-16 h-16 object-cover rounded">
                                        </td>
                                        <td class="px-4 py-3">{{ $berita->judul }}</td>
                                        <td class="px-4 py-3">{{ Str::limit($berita->isi, 50, '...') }}</td>
                                        <td class="px-4 py-3">{{ $berita->kategori ->nama }}</td>
                                        <td class="px-4 py-3">{{ $berita->created_at}}</td>
                                        <td class="px-4 py-3 flex items-center justify-end space-x-2">
                                            <button class="px-3 py-1 bg-green-500 text-white rounded" type="button"
                                                onclick="window.location='{{ route('berita.edit', $berita->id) }}'">
                                                Edit
                                            </button>
                                            <form action="{{ route('berita.destroy', $berita->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus berita ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <form method="GET" action="{{ route('berita.index') }}">
                        <div class="py-4 px-3">
                            <div class="flex">
                                <div class="flex space-x-4 items-center mb-3">
                                    <label class="w-32 text-sm font-medium text-gray-900">Per Page</label>
                                    <select name="per_page" onchange="this.form.submit()"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                        <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                        <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                                    </select>
                                </div>
                            </div>
                            {{ $beritas->appends(['per_page' => request('per_page')])->links() }}
                        </div>
                    </form>

                </div>
            </div>
        </section>

    </div>
</x-app-layout>
