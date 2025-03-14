<aside class=" md:min-w-[300px] md:sticky md:left-0 min-w-full h-screen  fixed top-0   z-10 md:bg-gray-100 transition-all flex flex-col bg-slate-200" :class="{'left-[-100%]': ! sidebarOpen, 'left-0': sidebarOpen }">
    <div class="logo p-4 flex justify-between">
        <a href="{{ route('dashboard') }}">
            LARAVEl
        </a>
        <button @click="sidebarOpen = ! sidebarOpen" class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{'hidden': sidebarOpen, 'inline-flex': ! sidebarOpen }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{'hidden': ! sidebarOpen, 'inline-flex': sidebarOpen }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>



    <div class="flex px-4 py-4  flex-col flex-grow justify-between">
        <ul class=" ">
            <li>
                <span class="text-lg text-gray-600 block mb-2">Dashboard</span>
                <a href="{{route("dashboard")}}" class="block   px-4 py-2 {{request()->routeIs(("dashboard")) ? 'bg-indigo-600 text-white' : 'text-slate-700 md:hover:bg-white/80'}} transition-all  rounded-md text-base flex items-center gap-2"><i class="fa w-[30px] fa-border-all text-lg"></i> Dashboard</a>
            </li>
            <hr class="block mt-6 mb-2 border-slate-300">


            <li>
                <span class="text-lg text-gray-600 block mb-2">Master Data</span>
                <ul>
                    <li>
                        <a href="{{route("dashboard")}}" class="block   px-4 py-2 {{request()->routeIs(("profile.edit")) ? 'bg-indigo-600 text-white' : 'text-slate-700 md:hover:bg-white/80'}} transition-all  rounded-md text-base flex items-center gap-2"><i class="fa w-[30px] fa-users text-lg"></i> Petugas</a>
                    </li>
                    <li>
                        <a href="{{route("dashboard")}}" class="block   px-4 py-2 {{request()->routeIs(("profile.edit")) ? 'bg-indigo-600 text-white' : 'text-slate-700 md:hover:bg-white/80'}} transition-all  rounded-md text-base flex items-center gap-2"><i class="fa w-[30px] fa-border-all text-lg"></i> Berita</a>
                    </li>
                    <li>
                        <a href="{{route("dashboard")}}" class="block   px-4 py-2 {{request()->routeIs(("profile.edit")) ? 'bg-indigo-600 text-white' : 'text-slate-700 md:hover:bg-white/80'}} transition-all  rounded-md text-base flex items-center gap-2"><i class="fa w-[30px] fa-users text-lg"></i> Anggota</a>
                    </li>
                </ul>
            </li>

        </ul>
        <ul>
            <li>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class=" md:shadow-sm px-4 py-2 text-slate-700 md:bg-white/80 bg-gray-100  transition-all  rounded-md text-base flex w-full items-center gap-2 "><i class="fa w-[30px] fa-arrow-right-from-bracket  text-lg"></i> Logout</button>
                </form>
            </li>
        </ul>
    </div>
</aside>
