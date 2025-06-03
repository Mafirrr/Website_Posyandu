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

    public function anggota()
    {
        return $this->hasMany(Anggota::class, 'posyandu_id');
    }

    public function pemeriksaanKehamilan()
    {
        return $this->hasMany(PemeriksaanKehamilan::class, 'tempat_pemeriksaan');
    }
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'lokasi');
    }
}
