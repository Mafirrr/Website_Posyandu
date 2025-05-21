<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            $user = Petugas::where('email', $request->identifier)->first()->makeHidden(['remember_token', 'created_at', 'updated_at', 'deleted_at']);
        }

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials.',
            ], 401);
        }



        // Buat token berdasarkan role
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
        // Validate the incoming request
        $request->validate([
            'phone' => 'required',
            'password' => 'required|min:8',
        ]);

        $phone = $request->phone;
        $password = $request->password;

        if (substr($phone, 0, 2) === '08') {
            $phone = '+628' . substr($phone, 2);
        }

        // Find the user
        $user = Anggota::where('no_telepon', $phone)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User with this phone number not found.',
            ], 404);
        }

        // Update password
        $user->password = Hash::make($password);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Password has been successfully updated.',
            'phone' => $phone
        ]);
    }
}
