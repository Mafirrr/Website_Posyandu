<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Anggota extends Model
{
    use Notifiable, HasFactory, SoftDeletes, HasApiTokens;
    protected $table = 'anggota';

    protected $fillable = [
        'nik',
        'password',
        'nama',
        'tanggal_lahir',
        'tempat_lahir',
        'pekerjaan',
        'alamat',
        'no_telepon',
        'golongan_darah'
    ];

    protected $hidden = [
        'password',
    ];

    // Relasi ke tabel lain (jika ada)
    public function kehamilan()
    {
        return $this->hasMany(Kehamilan::class, 'anggota_id');
    }

    public function riwayatImunisasi()
    {
        return $this->hasMany(RiwayatImunisasiTetanus::class, 'anggota_id');
    }

    public function kesehatan()
    {
        return $this->hasOne(Kesehatan_Anggota::class, 'anggota_id');
    }
}
