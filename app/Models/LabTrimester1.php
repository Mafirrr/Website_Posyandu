<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LabTrimester1 extends Model
{
    use SoftDeletes;

    protected $table = 'lab_trimester_1';

    protected $fillable = [
        'hemoglobin',
        'golongan_darah_dan_rhesus',
        'gula_darah',
        'hemoglobin_rtl',
        'rhesus_rtl',
        'gula_darah_rtl',
        'hiv',
        'sifilis',
        'hepatitis_b',
    ];

    protected $casts = [
        'hemoglobin' => 'float',
        'gula_darah' => 'float',
    ];

    public function trimester1()
    {
        return $this->hasOne(Trimester1::class, 'lab_trimester_1');
    }
}
