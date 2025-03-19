<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RiwayatImunisasiTetanus extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'riwayat_imunisasi_tetanus';

    protected $fillable = [
        'anggota_id',
        'tanggal_pemberian',
        'dosis'
    ];

    protected $casts = [
        'tanggal_pemberian' => 'date',
    ];

    // Relasi ke tabel Anggota
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }
}
