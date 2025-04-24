<aside class="fixed top-0 left-0 h-screen w-64 bg-white border-r z-10 flex flex-col shadow-md" x-data="{ penggunaOpen: {{ request()->is('ibu-hamil*') ? 'true' : 'false' }}, posyanduOpen: {{ request()->is('jadwal*') || request()->is('pemeriksaan*') ? 'true' : 'false' }} }">
    <div class="flex items-center justify-between px-4 py-4 border-b">
        <span class="font-bold text-xl text-blue-600">Posyandu</span>
        <button class="md:hidden p-2 text-gray-600">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <nav class="flex-1 px-4 py-6 overflow-y-auto">
        <ul class="space-y-4">

            <li class="mt-2">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg transition {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white' : 'text-gray-700 hover:bg-blue-100' }}">
                    <i class="fa fa-home w-5"></i> Dashboard
                </a>
            </li>

            <li class="mt-6">
                <button @click="penggunaOpen = !penggunaOpen"
                    class="w-full flex items-center gap-3 px-3 py-2 rounded-lg transition focus:outline-none
                         {{ request()->is('ibu-hamil*') ? 'bg-indigo-600 text-white' : 'text-gray-700 hover:bg-blue-100' }}">
                    <i class="fa fa-user w-5"></i>
                    Data Pengguna
                    <svg :class="{ 'rotate-90': penggunaOpen }" class="ml-auto h-4 w-4 transition-transform"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <ul x-show="penggunaOpen" class="pl-8 mt-1 space-y-1 text-sm">
                    <li>
                        <a href="{{ route('anggota.index') }}"
                            class="block py-1 hover:text-blue-600 {{ request()->routeIs('anggota.index') ? 'text-indigo-600 font-semibold' : 'text-gray-600' }}">
                            Data Ibu Hamil
                        </a>
                    </li>
                </ul>
            </li>

            <li class="mt-6">
                <button @click="posyanduOpen = !posyanduOpen"
                    class="w-full flex items-center gap-3 px-2 py-2 rounded-lg transition focus:outline-none
                         {{ request()->is('jadwal*') || request()->is('pemeriksaan*') ? 'bg-indigo-600 text-white' : 'text-gray-700 hover:bg-blue-100' }}">
                    <i class="fa fa-stethoscope w-5"></i>
                    Pelayanan Posyandu
                    <svg :class="{ 'rotate-90': posyanduOpen }" class="ml-auto h-4 w-4 transition-transform"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <ul x-show="posyanduOpen" class="pl-8 mt-1 space-y-1 text-sm">
                    <li><a href="#" class="block py-1 hover:text-blue-600 text-gray-600">Jadwal Posyandu</a></li>
                    <li><a href="#" class="block py-1 hover:text-blue-600 text-gray-600">Pemeriksaan Kesehatan</a>
                    </li>
                    <li><a href="#" class="block py-1 hover:text-blue-600 text-gray-600">Riwayat Pemeriksaan</a>
                    </li>
                </ul>
            </li>
            <li class="mt-6">
                <a href="#"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg transition {{ request()->routeIs('edukasi.index') ? 'bg-indigo-600 text-white' : 'text-gray-700 hover:bg-blue-100' }}">
                    <i class="fa fa-book w-5"></i> Edukasi
                </a>
            </li>
        </ul>
    </nav>

    <div class="px-4 py-4 border-t">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center gap-2 w-full text-gray-700 hover:text-red-500 transition">
                <i class="fa fa-sign-out-alt w-5"></i>
                Keluar
            </button>
        </form>
    </div>
</aside>
