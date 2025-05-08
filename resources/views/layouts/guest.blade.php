<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased bg-white">
    <div class="min-h-screen flex">
        <!-- Form Login Section -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center px-10 lg:px-32 pt-0">
            <div class="mb-16 flex items-center space-x-4">
                <img src="{{ asset('storage/images/logo.png') }}" alt="logo" class="w-100 h-100">
                <h2 class="text-3xl font-semibold">Posyandu</h2>
            </div>
            {{ $slot }}
        </div>
        <!-- Image Section -->
        <div class="hidden lg:flex w-1/2 items-center justify-center ">
            <img src="{{ asset('storage/images/log.png') }}" alt="Login Illustration" class="max-w-full">
        </div>
    </div>
</body>

</html>
