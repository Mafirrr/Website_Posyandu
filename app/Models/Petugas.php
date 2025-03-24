<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Petugas extends Model
{
    use HasFactory, SoftDeletes, HasApiTokens;

    protected $table = 'petugas';

    protected $fillable = [
        'nip',
        'password',
        'nama',
        'no_telepon',
        'email',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'role' => 'string',
    ];

    // Relasi ke tabel Pemeriksaan Trimester 1
    public function pemeriksaanTrimester1()
    {
        return $this->hasMany(PemeriksaanTrimester1::class, 'petugas_id');
    }

    // Relasi ke tabel Pemeriksaan Trimester 3
    public function pemeriksaanTrimester3()
    {
        return $this->hasMany(PemeriksaanTrimester3::class, 'petugas_id');
    }

    // Relasi ke tabel Nifas
    public function nifas()
    {
        return $this->hasMany(Nifas::class, 'petugas_id');
    }
}
