<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FCMTokenController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'fcm_token' => 'required|string',
        ]);

        $anggota = $request->user();

        $anggota->fcm_token = $request->fcm_token;
        $anggota->save();

        return response()->json([
            'message' => 'FCM token updated successfully',
        ]);
    }
}
