<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Petugas;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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
            $user = Petugas::where('email', $request->identifier)->first();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak ditemukan.',
                ], 404);
            }
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password salah.',
            ], 401);
        }


        $tokenName = ($user instanceof Anggota) ? 'anggota_token' : 'petugas_token';
        $token = $user->createToken($tokenName)->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful.',
            'user' => $user,
            'role' => ($user instanceof Anggota) ? 'anggota' : 'petugas',
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

        $user = Petugas::where('email', $identifier)->first();

        if (!$user) {
            if (substr($identifier, 0, 2) === '08') {
                $identifier = '+628' . substr($identifier, 2);
            }
            $user = Anggota::where('no_telepon', $identifier)->first();
        }

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
        $request->validate(['email' => 'required|email']);
        $user = Petugas::where('email', $request->email)->first();
        if (!$user) return response()->json(['message' => 'Email tidak terdaftar'], 404);

        $otp = rand(100000, 999999);
        Cache::put('otp_' . $request->email, $otp, now()->addMinutes(2));

        Mail::raw("Kode OTP Anda: $otp", function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Kode OTP Lupa Password');
        });

        return response()->json(['message' => 'OTP telah dikirim ke email']);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required'
        ]);

        $storedOtp = Cache::get('otp_' . $request->email);
        if ($storedOtp && $storedOtp == $request->otp) {
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

        if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {

            $storedOtp = Cache::get('otp_' . $identifier);

            if (!$storedOtp || $storedOtp != $request->otp) {
                return response()->json(['message' => 'OTP tidak valid'], 400);
            }

            $user = Petugas::where('email', $identifier)->first();
            if (!$user) {
                return response()->json(['message' => 'Petugas tidak ditemukan'], 404);
            }
            $user->password = Hash::make($request->password);
            $user->save();
            Cache::forget('otp_' . $identifier);
            return response()->json(['message' => 'Password petugas berhasil direset']);
        } else {

            $user = Anggota::where('no_telepon', $identifier)->first();
            if (!$user) {
                return response()->json(['message' => 'Anggota tidak ditemukan'], 404);
            }
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json(['message' => 'Password anggota berhasil direset']);
        }
    }
}
