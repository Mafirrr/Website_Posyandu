<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PemeriksaanLabAkhir extends Model
{
    use SoftDeletes;

    protected $table = 'pemeriksaan_lab_akhir';

    protected $fillable = [
        'pemeriksaan_id',
        'Hemoglobin',
        'Protein_urin',
        'urin_reduksi',
    ];

    protected $casts = [
        'Hemoglobin' => 'float',
        'Protein_urin' => 'float',
    ];

    public function pemeriksaan()
    {
        return $this->belongsTo(PemeriksaanKehamilan::class, 'pemeriksaan_id');
    }
}
