<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;

class OtpController extends Controller
{

    public function index()
    {
        return view('auth.reset-password-otp');
    }
    public function show()
    {
        return view('auth.verify-otp');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
            'user_id' => 'required|integer',
        ]);

        $cachedOtp = cache('otp-for-' . $request->user_id);

        if (!$cachedOtp || $cachedOtp != $request->otp) {
            return back()->withErrors(['otp' => 'Kode OTP salah atau telah kedaluwarsa.']);
        }

        cache()->forget('otp-for-' . $request->user_id);

        session(['reset_user_id' => $request->user_id]);
        return redirect()->route('otp.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'password' => 'required|string|confirmed|min:6',
        ]);

        $anggota = Anggota::where('id', $request->user_id)->first();

        if (!$anggota) {
            return back()->withErrors(['user_id' => 'ID tidak ada.']);
        }

        $anggota->password = bcrypt($request->password);
        $anggota->save();

        return redirect()->route('login')->with('status', 'Kata sandi berhasil diubah. Silakan login.');
    }
}
