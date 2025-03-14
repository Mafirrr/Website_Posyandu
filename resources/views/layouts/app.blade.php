@props(["title"])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @if(isset($title))
        {{ $title }} |
        @endif
        {{ config('app.name', 'SiBADEAN') }}
    </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class=" antialiased">
    <div class="min-h-screen flex" x-data="{ sidebarOpen: false,  message: '-',url:'-' }">
        @include('layouts.sidebar')

        <!-- Page Content -->
        <main class="w-full bg-white">
            @include('layouts.navigation')
            {{ $slot }}
        </main>

        <!-- Modal -->
        <x-modal :name="'delete'">
            <form :action="url" method="post" class="p-4">
                <h6 class="font-bold text-lg">Pemberitahuan</h6>
                @csrf
                @method("delete")
                <p x-text="message" class="text-lg"></p>
                <p class="text-slate-500 text-sm">Data akan dihapus secara permanent dan tidak dapat dipulihkan</p>
                <div class="flex md:justify-end flex-wrap-reverse gap-2 mt-10">
                    <button x-data x-on:click="$dispatch('close-modal',{name:'delete'})" type="button" class="md:w-auto w-full px-4 py-2 bg-slate-200 rounded-md text-black">Batal</button>
                    <button type="submit" class="md:w-auto w-full px-4 py-2 bg-red-500 rounded-md text-white">Hapus</button>
                </div>
            </form>
        </x-modal>

    </div>



    @if(isset($script))
    {{ $script }}
    @endif



</body>

</html>
