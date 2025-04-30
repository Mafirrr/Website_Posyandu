<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class kategori extends Model
{
    use HasFactory, SoftDeletes;

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
