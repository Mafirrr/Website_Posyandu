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
        'no_jkn',
        'faskes_tk1',
        'faskes_rujukan',
        'tanggal_lahir',
        'tempat_lahir',
        'pekerjaan',
        'alamat',
        'no_telepon',
        'golongan_darah',
        'aktif',
        'fcm_token',
    ];

    protected $hidden = [
        'password',
    ];

    public function setAktifAttribute($value)
    {
        $this->attributes['aktif'] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }


    // Relasi ke tabel lain (jika ada)
    public function kehamilan()
    {
        return $this->hasMany(Kehamilan::class, 'anggota_id');
    }
}
