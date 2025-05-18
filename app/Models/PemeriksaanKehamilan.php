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
        'tanggal_pemeriksaan',
        'tempat_pemeriksaan',
        'jenis_pemeriksaan',
    ];

    /**
     * Relasi ke tabel kehamilan
     */
    public function kehamilan()
    {
        return $this->belongsTo(Kehamilan::class, 'kehamilan_id');
    }

    /**
     * Relasi ke tabel petugas
     */
    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'petugas_id');
    }

    /**
     * Relasi ke tabel pemeriksaan rutin
     */
    public function pemeriksaanRutin()
    {
        return $this->hasMany(PemeriksaanRutin::class, 'pemeriksaan_id');
    }
}
