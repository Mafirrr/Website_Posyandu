<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Masukkan kode OTP yang telah dikirim ke WhatsApp Anda.') }}
    </div>

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('otp.verify') }}">
        @csrf

        <div>
            <x-input-label for="otp" :value="__('Kode OTP')" />
            <x-text-input id="otp" class="block mt-1 w-full" type="text" name="otp" required autofocus />
            <x-input-error :messages="$errors->get('otp')" class="mt-2" />
        </div>

        <input type="hidden" name="user_id" value="{{ session('otp_user_id') }}">

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Verifikasi OTP') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
