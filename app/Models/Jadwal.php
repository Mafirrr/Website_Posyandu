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
    ];
    public $timestamps = false;

    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'lokasi');
    }
}
