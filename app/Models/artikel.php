<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class artikel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'artikels';

    protected $fillable = [
        'judul',
        'slug',
        'isi',
        'gambar',
        'Kategori_edukasi',
    ];

    
}
