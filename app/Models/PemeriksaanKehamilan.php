<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PemeriksaanKehamilan extends Model
{
    use SoftDeletes;

    protected $table = 'pemeriksaan_kehamilan';

    protected $fillable = [
        'kehamilan_id',
        'petugas_id',
        'kader_id',
        'tanggal_pemeriksaan',
        'tempat_pemeriksaan',
        'jenis_pemeriksaan',
    ];
    // app/Models/PemeriksaanKehamilan.php
    protected $casts = [
        'tanggal_pemeriksaan' => 'datetime',
    ];


    /**
     * Relasi ke tabel kehamilan
     */
    public function kehamilan()
    {
        return $this->belongsTo(Kehamilan::class, 'kehamilan_id');
    }

    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'tempat_pemeriksaan');
    }
    /**
     * Relasi ke tabel petugas
     */
    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'petugas_id');
    }

    public function trimester1()
    {
        return $this->hasMany(Trimester1::class, 'pemeriksaan_id');
    }

    public function trimester3()
    {
        return $this->hasMany(Trimester3::class, 'pemeriksaan_id');
    }

    /**
     * Relasi ke tabel pemeriksaan rutin
     */
    public function pemeriksaanRutin()
    {
        return $this->hasOne(PemeriksaanRutin::class, 'pemeriksaan_id');
    }
    public function nifas()
    {
        return $this->hasMany(Nifas::class, 'pemeriksaan_id');
    }
}
