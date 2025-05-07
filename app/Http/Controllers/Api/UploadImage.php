<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Interfaces\ImageManagerInterface;


class UploadImage extends Controller
{
    public function uploadPhoto(Request $request, ImageManagerInterface $imageManager)
    {
        $request->validate([
            'id' => 'required',
            'photo' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        $file = $request->file('photo');
        $filename = 'profile_' . $request->id . '.' . 'jpeg';


        // Buat instance gambar dan kompres
        $image = $imageManager->read($file->getRealPath())
            ->resizeDown(1080, null)
            ->toJpeg(80);

        Storage::disk('public')->put("profiles/{$filename}", (string) $image);
        $url = asset('storage/profiles/' . $filename);

        return response()->json([
            'status' => 'succcess',
            'message' => 'Uploaded & compressed',
            'url' => $url
        ]);
    }

    public function getImage(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $path = 'profiles/profile_' . $request->id . '.jpeg';

        if (!Storage::disk('public')->exists($path)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Image tidak ditemukan',
            ], 404);
        }

        $url = asset('storage/' . $path);

        return response()->json([
            'status' => 'success',
            'message' => 'Image ditemukan',
            'url' => $url,
        ]);
    }
}
