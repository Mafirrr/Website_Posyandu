<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $fillable = [
        'judul',
        'lokasi',
        'jam_mulai',
        'jam_selesai',
        'tanggal',
        'yang_menghadiri',
    ];

    protected $casts = [
        'yang_menhadiri' => 'array',
        'tanggal' => 'date',
    ];

    public function getTanggalAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('Y-m-d');
    }

    public $timestamps = false;

    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'lokasi');
    }
}
