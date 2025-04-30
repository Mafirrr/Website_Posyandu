<x-app-layout>
    <div>
        <div class="flex items-center justify-between m-5">
            <h2 class="text-2xl font-semibold">Data Anggota</h2>
        </div>

        <section class="mt-5 mb-10">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <!-- Start coding here -->
                <div class="bg-white dark:bg-white relative shadow-md sm:rounded-lg overflow-hidden">
                    <div class="flex items-center justify-between d p-4">
                        <div class="flex">
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                        fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <form id="search-form" method="GET" action="{{ route('anggota.index') }}">
                                    <div class="relative w-full">
                                        <input id="search-input" type="text" name="search"
                                            value="{{ request('search') }}" placeholder="Search"
                                            class="bg-gray-50 border border-gray-500 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2">
                                    </div>
                                </form>
                                <script>
                                    function debounce(fn, delay) {
                                        let timeoutID;
                                        return function (...args) {
                                            clearTimeout(timeoutID);
                                            timeoutID = setTimeout(() => fn.apply(this, args), delay);
                                        };
                                    }

                                    const searchInput = document.getElementById('search-input');
                                    const searchForm = document.getElementById('search-form');

                                    searchInput.addEventListener('input', debounce(() => {
                                        searchForm.submit();
                                    }, 1000));
                                </script>


                            </div>
                        </div>
                        <form method="GET" action="{{ route('anggota.index') }}">
                            <div class="flex space-x-3 items-center">
                                <label class="w-40 text-sm font-medium text-gray-900">Keaktifan :</label>
                                <select name="aktif" onchange="this.form.submit()"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="">All</option>
                                    <option value="1" {{ request('aktif') === '1' ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ request('aktif') === '0' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-black dark:text-black">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                                <tr>
                                    <th scope="col" class="px-4 py-3">NO.</th>
                                    <th scope="col" class="px-4 py-3">NIK</th>
                                    <th scope="col" class="px-4 py-3">Nama</th>
                                    <th scope="col" class="px-4 py-3">Alamat</th>
                                    <th scope="col" class="px-4 py-3">No Telepon</th>
                                    <th scope="col" class="px-4 py-3">Status</th>
                                    <th scope="col" class="px-4 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($anggotas as $anggota)
                                    <tr class="border-b dark:border-gray-500">
                                        <th scope="row"
                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                                            {{ $anggota->id }}
                                        </th>
                                        <td class="px-4 py-3">{{ $anggota->nik }}</td>
                                        <td class="px-4 py-3">{{ $anggota->nama }}</td>
                                        <td class="px-4 py-3">{{ $anggota->alamat }}</td>
                                        <td class="px-4 py-3">{{ $anggota->no_telepon }}</td>
                                        <td class="px-4 py-3 {{ $anggota->aktif ? 'text-green-500' : 'text-red-500' }}">
                                            {{ $anggota->aktif ? 'Aktif' : 'Nonaktif' }}
                                        </td>
                                        <td class="px-4 py-3 flex items-center justify-end space-x-2">
                                            <button class="px-3 py-1 bg-green-500 text-white rounded" type="button"
                                                onclick="window.location='{{ route('anggota.edit', $anggota->id) }}'">
                                                Edit
                                            </button>
                                            <form action="{{ route('anggota.destroy', $anggota->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus data ini?');">
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

                    <form method="GET" action="{{ route('anggota.index') }}">
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
                                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100
                                        </option>
                                    </select>
                                </div>
                            </div>
                            {{ $anggotas->appends(['per_page' => request('per_page')])->links() }}
                        </div>
                    </form>

                </div>
            </div>
        </section>

    </div>
</x-app-layout>