<x-guest-layout :image="'log.png'">
    <h2 class="text-3xl font-bold mb-2">Masuk</h2>
    <p class="text-gray-500 mb-6">
        Masuk untuk Memantau dan Mencatat Kesehatan Ibu Hamil <br>
        dengan Mudah Setiap Hari!
    </p>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-4">
            <label for="login" class="block text-sm font-medium text-gray-700">Email atau Nik</label>
            <input id="login" type="text" name="login" value="{{ old('login') }}" required autofocus
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            <x-input-error :messages="$errors->get('login')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <div class="relative">
                <input id="password" type="password" name="password" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 pr-10">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                    <i id="togglePassword" class="fa fa-eye"></i>
                </div>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember me & Forgot password -->
        <div class="flex items-center justify-between mb-6">
            <label class="inline-flex items-center text-sm text-gray-600">
                <input type="checkbox" name="remember"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <span class="ml-2">Remember me</span>
            </label>
            @if (Route::has('password.request'))
                <a class="text-sm text-indigo-600 hover:underline" href="{{ route('password.request') }}">
                    Lupa Password ?
                </a>
            @endif
        </div>

        <button type="submit"
            class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 transition">
            Masuk
        </button>
    </form>
</x-guest-layout>
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    togglePassword.addEventListener('click', function(e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon
        if (this.classList.contains('fa-eye')) {
            this.classList.remove('fa-eye');
            this.classList.add('fa-eye-slash');
        } else {
            this.classList.add('fa-eye');
            this.classList.remove('fa-eye-slash');
        }
    });
</script>
