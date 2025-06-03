<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posyandu extends Model
{
    use HasFactory;

    protected $table = 'posyandu';

    protected $fillable = [
        'nama',
        'alamat',
    ];

    // Relasi: Satu posyandu punya banyak ibu hamil
    public function ibuHamil()
    {
        return $this->hasMany(Anggota::class, 'posyandu_id');
    }
}
