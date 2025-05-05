<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artikel = Artikel::orderBy('created_at', 'desc')->get()->map(function ($item) {
            $item->gambar = asset('storage/' . $item->gambar);
            return $item;
        });


        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Didapatkan.',
            'artikel' => $artikel,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $artikel = Artikel::find($id);

        if (!$artikel) {
            return response()->json([
                'success' => false,
                'message' => 'Artikel tidak ditemukan.',
            ], 404);
        }

        $artikel->makeHidden(['created_at', 'updated_at', 'deleted_at']);
        $artikel->gambar = asset('storage/' . $artikel->gambar);

        return response()->json([
            'success' => true,
            'message' => 'Detail artikel berhasil diambil.',
            'artikel' => $artikel,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
