<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class KeluargaAnggota extends Model
{
    use HasFactory, SoftDeletes, HasApiTokens;

    protected $table = 'keluarga_anggota';

    protected $fillable = [
        'anggota_id',
        'nik',
        'nama',
        'no_jkn',
        'faskes_tk1',
        'faskes_rujukan',
        'tanggal_lahir',
        'tempat_lahir',
        'pekerjaan',
        'alamat',
        'no_telepon',
    ];

    protected $casts = [
        'anggota_id' => 'integer',
    ];
    protected $dates = ['tanggal_lahir', 'deleted_at'];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }
}
