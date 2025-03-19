<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class kesehatan_anggota extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kesehatan_anggota';

    protected $fillable = [
        'anggota_id',
        'tinggi_badan',
        'berat_badan',
        'tekanan_darah_sistolik',
        'tekanan_darah_diastolik',
    ];

    protected $casts = [
        'tinggi_badan' => 'integer',
        'berat_badan' => 'double',
        'tekanan_darah_sistolik' => 'integer',
        'tekanan_darah_diastolik' => 'integer',
    ];

    // Relasi ke tabel Anggota
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }
}
