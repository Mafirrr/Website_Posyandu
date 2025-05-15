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
     * Relasi ke tabel pemeriksaan fisik
     */
    public function pemeriksaanFisik()
    {
        return $this->hasOne(PemeriksaanFisik::class, 'pemeriksaan_id');
    }

    // Kamu juga bisa menambahkan relasi ke tabel pemeriksaan lain:
    public function pemeriksaanRutin()
    {
        return $this->hasOne(PemeriksaanRutin::class, 'pemeriksaan_id');
    }

    public function pemeriksaanKhusus()
    {
        return $this->hasOne(PemeriksaanKhusus::class, 'pemeriksaan_id');
    }

    public function pemeriksaanAwal()
    {
        return $this->hasOne(PemeriksaanAwal::class, 'pemeriksaan_id');
    }

    public function pemeriksaanLabAkhir()
    {
        return $this->hasOne(PemeriksaanLabAkhir::class, 'pemeriksaan_id');
    }
    public function pemeriksaanLabAwal()
    {
        return $this->hasOne(PemeriksaanLabAkhir::class, 'pemeriksaan_id');
    }

    public function skriningKesehatanJiwa()
    {
        return $this->hasOne(SkriningKesehatanJiwa::class, 'pemeriksaan_id');
    }

    public function rencanaKonsultasi()
    {
        return $this->hasOne(RencanaKonsultasi::class, 'pemeriksaan_id');
    }
}
