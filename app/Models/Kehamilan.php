<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kehamilan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kehamilan';

    protected $fillable = [
        'anggota_id',
        'status',
        'proses_melahirkan',
        'penolong',
        'masalah',
    ];

    protected $casts = [
        'anggota_id' => 'integer',
        'usia_kehamilan_awal' => 'integer',
        'perkiraan_kehamilan' => 'date',
        'status' => 'string'
    ];

    public function getTanggalAwalAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }
}
