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
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $file = $request->file('photo');
        $filename = uniqid('profile_') . '.' . $file->getClientOriginalExtension();
        // $path = storage_path("app/public/profiles/{$filename}");

        // Buat instance gambar dan kompres
        $image = $imageManager->read($file->getRealPath())
            ->resizeDown(1080, null) // resizeDown jaga proporsi
            ->toJpeg(80); // kompres ke jpeg dengan kualitas 80

        Storage::disk('private')->put("profiles/{$filename}", (string) $image);

        return response()->json([
            'message' => 'Uploaded & compressed',
            'photo_url' => asset("storage/profiles/{$filename}")
        ]);
    }

    public function getImage(string $filename)
    {
        $path = 'images/' . $filename;

        if (!Storage::disk('private')->exists($path)) {
            Log::error("File not found: " . $path);
            abort(404);
        }

        $file = Storage::disk('private')->get($path);
        $type = Storage::disk('private')->mimeType($path);

        return response($file, 200)->header('Content-Type', $type);
    }
}
