<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Anggota extends  Authenticatable
{
    use Notifiable, HasFactory, SoftDeletes, HasApiTokens;
    protected $table = 'anggota';

    protected $fillable = [
        'nik',
        'password',
        'nama',
        'role',
        'no_jkn',
        'faskes_tk1',
        'faskes_rujukan',
        'tanggal_lahir',
        'tempat_lahir',
        'pekerjaan',
        'alamat',
        'posyandu_id',
        'no_telepon',
        'golongan_darah',
        'aktif',
        'fcm_token',
    ];

    protected $hidden = [
        'password',
    ];

    public function getAuthIdentifierName()
    {
        return 'nik';
    }

    public function setAktifAttribute($value)
    {
        $this->attributes['aktif'] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    public function isKader()
    {
        return $this->role === 'kader' || $this->role === 'ibu_hamil_kader';
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    public function isIbuHamil()
    {
        return $this->role === 'ibu_hamil' || $this->role === 'ibu_hamil_kader';
    }

    public function kehamilan()
    {
        return $this->hasMany(Kehamilan::class, 'anggota_id');
    }

    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class);
    }
}
