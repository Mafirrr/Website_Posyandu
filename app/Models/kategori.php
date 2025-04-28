<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{

    protected $table = 'kategori';
    protected $fillable = [
        'nama',
        'deskripsi'
    ];

    public function artikels()
    {
        return $this->hasMany(Artikel::class, 'kategori_id');
    }

public function create()
{
    $categories = Kategori::all(); // Ambil semua kategori dari database
    return view('form', compact('categories'));
}

}
