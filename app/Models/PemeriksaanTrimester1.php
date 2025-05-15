<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PemeriksaanTrimester1 extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pemeriksaan_trimester1';

    protected $fillable = [
        'kehamilan_id',
        'petugas_id',
        'tanggal_pemeriksaan',
        'konjungtiva',
        'sklera',
        'kulit',
        'leher',
        'gigi_mulut',
        'tht',
        'jantung',
        'paru',
        'perut',
        'tungkai',
        'gestational_sac',
        'crown_rump_length',
        'denyut_jantung_janin',
        'usia_kehamilan',
        'kantong_kehamilan'
    ];

    protected $casts = [
        'gestational_sac' => 'double',
        'crown_rump_length' => 'double',
        'denyut_jantung_janin' => 'integer',
        'usia_kehamilan' => 'integer',
        'kantong_kehamilan' => 'boolean',
    ];

    public function getTanggalPemeriksaanAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }
    // Relasi ke tabel Kehamilan
    public function kehamilan()
    {
        return $this->belongsTo(Kehamilan::class, 'kehamilan_id');
    }

    // Relasi ke tabel Petugas
    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'petugas_id');
    }
}
