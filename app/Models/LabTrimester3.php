<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LabTrimester3 extends Model
{
    use SoftDeletes;

    protected $table = 'lab_trimester_3';

    protected $fillable = [
        'Hemoglobin',
        'Protein_urin',
        'urin_reduksi',
        'hemoglobin_rtl',
        'protein_urin_rtl',
        'urin_reduksi_rtl',
    ];

    protected $casts = [
        'Hemoglobin' => 'float',
        'Protein_urin' => 'float',
    ];

    public function trimester3()
    {
        return $this->hasMany(Trimester3::class, 'lab_trimester_3');
    }
}
