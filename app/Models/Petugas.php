<?php

namespace App\Models;


use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword as ResetPasswordTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Petugas extends Authenticatable implements CanResetPassword
{
    use HasFactory, SoftDeletes, HasApiTokens, Notifiable, ResetPasswordTrait;

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
    public function pemeriksaanKehamilan()
    {
        return $this->hasMany(PemeriksaanKehamilan::class, 'petugas_id');
    }
}
