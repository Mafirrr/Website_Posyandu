<x-guest-layout>
    <h2 class="text-3xl font-bold mb-2">Lupa Password?</h2>
    <p class="text-gray-500 mb-6">
        Jangan khawatir, itu bisa terjadi pada siapa saja. Masukkan No Telepon Anda di bawah ini untuk memulihkan kata
        sandi Anda.
    </p>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
