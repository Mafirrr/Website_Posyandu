<x-guest-layout :image="'lupa_pw.png'">
    <h2 class="text-3xl font-bold mb-2">Reset Password</h2>
    <p class="text-gray-500 mb-6">
        Buat kata sandi baru. Pastikan berbeda dari sebelumnya untuk keamanan.
    </p>
    <form method="POST" action="{{ route('otp.store') }}">
        @csrf

        <input type="hidden" name="user_id" value="{{ session('reset_user_id') }}">

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit"
                class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 transition">
                {{ __('Reset Password') }}
            </button>
        </div>
    </form>
</x-guest-layout>
