<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Petugas;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Helpers\NotificationHelper as HelpersNotificationHelper;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = Anggota::where('nik', $request->identifier)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan.',
            ], 404);
        }


        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password salah.',
            ], 401);
        }


        $tokenName = $user->role == 'ibu_hamil' ? 'anggota_token' : 'petugas_token';
        $token = $user->createToken($tokenName)->plainTextToken;


        return response()->json([
            'success' => true,
            'message' => 'Login successful.',
            'user' => $user,
            'role' => $user->role == 'ibu_hamil' ? 'anggota' : 'petugas',
            'token' => $token
        ], 200);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully'
        ], 200);
    }

    public function lupaPass(Request $request)
    {
        $request->validate([
            'identifier' => 'required'
        ]);

        $identifier = $request->identifier;

        if (substr($identifier, 0, 2) === '08') {
            $identifier = '+628' . substr($identifier, 2);
        }
        $user = Anggota::where('no_telepon', $identifier)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User with this phone number not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'User Di tumukan',
            'identifier' => $identifier,
        ]);
    }

    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required']);
        $noTelepon = $request->email;

        if (substr($noTelepon, 0, 2) === '08') {
            $noTelepon = '+628' . substr($noTelepon, 2);
        }
        $user = Anggota::where('no_telepon', $noTelepon)->first();
        if (!$user) return response()->json(['message' => 'Akun tidak terdaftar'], 404);

        $noHp = $this->formatPhone($user->no_telepon);

        $otp = rand(100000, 999999);
        $pesan = "Kode OTP reset password Anda adalah: $otp";

        HelpersNotificationHelper::sendFonnte($noHp, $pesan);

        cache()->put('otp-for-' . $user->id, $otp, now()->addMinutes(5));

        return response()->json(['message' => 'OTP telah dikirim ke email', "user_id" => $user->id,]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
            'user_id' => 'required|integer',
        ]);


        $cachedOtp = cache('otp-for-' . $request->user_id);

        if ($cachedOtp && $cachedOtp == $request->otp) {
            cache()->forget('otp-for-' . $request->user_id);
            return response()->json(['message' => 'OTP valid']);
        }


        return response()->json(['message' => 'OTP salah atau kadaluarsa'], 400);
    }


    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identifier' => 'required',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validasi gagal', 'errors' => $validator->errors()], 422);
        }

        $identifier = $request->identifier;

        $user = Anggota::where('no_telepon', $identifier)->first();
        if (!$user) {
            return response()->json(['message' => 'Anggota tidak ditemukan'], 404);
        }
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json(['message' => 'Password anggota berhasil direset']);
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
