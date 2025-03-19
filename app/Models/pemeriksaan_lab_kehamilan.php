<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pemeriksaan_lab_kehamilan extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'pemeriksaan_lab_kehamilan';

    protected $fillable = [
        'pemeriksaan_kehamilan_id',
        'hemogoblin',
        'gula_darah',
        'protein_urine',
        'hepatitis_b'
    ];

    protected $casts = [
        'hemogoblin' => 'double',
        'gula_darah' => 'double',
    ];

    // Relasi ke tabel Pemeriksaan Kehamilan
    public function pemeriksaanKehamilan()
    {
        return $this->belongsTo(Pemeriksaan_Kehamilan::class, 'pemeriksaan_kehamilan_id');
    }
}
