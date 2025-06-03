<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Petugas;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use App\Http\Helpers\NotificationHelper as HelpersNotificationHelper;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'login' => ['required', 'string'],
        ]);

        $login = $request->input('login');
        $status = null;

        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {

            $user = Petugas::where('email', $login)->first();

            if (!$user) {
                return back()->withErrors(['login' => 'Email tidak ditemukan.']);
            }

            $status = Password::sendResetLink(['email' => $user->email]);

            return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['login' => __($status)]);
        } else {
            $user = Anggota::where('nik', $login)->first();
            if (!$user) {
                return back()->withErrors(['login' => 'NIK tidak ditemukan.']);
            }

            if ($user->no_telepon) {
                $noHp = $this->formatPhone($user->no_telepon);

                $otp = rand(100000, 999999);
                $pesan = "Kode OTP reset password Anda adalah: $otp";

                HelpersNotificationHelper::sendFonnte($noHp, $pesan);

                cache()->put('otp-for-' . $user->id, $otp, now()->addMinutes(5));
                session(['otp_user_id' => $user->id]);

                return redirect()->route('otp.form')
                    ->with('status', 'Kode OTP telah dikirim ke WhatsApp Anda.');
            }

            return back()->withErrors(['login' => 'Nomor HP tidak tersedia untuk akun ini.']);
        }
    }

    private function formatPhone($noHp)
    {
        $noHp = preg_replace('/[\s\-]/', '', $noHp);

        if (str_starts_with($noHp, '+62')) {
            return '0' . substr($noHp, 3);
        }

        if (str_starts_with($noHp, '62')) {
            return '0' . substr($noHp, 2);
        }

        return $noHp;
    }
}
