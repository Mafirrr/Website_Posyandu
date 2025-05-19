<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SkriningKesehatanJiwa extends Model
{
    use SoftDeletes;

    protected $table = 'skrining_kesehatan_jiwa';

    protected $fillable = [
        'skrining_jiwa',
        'tindak_lanjut_jiwa',
        'perlu_rujukan',
    ];

    public function trimester1()
    {
        return $this->hasOne(Trimester1::class, 'skrining_kesehatan');
    }
    public function trimester3()
    {
        return $this->hasOne(Trimester3::class, 'skrining_kesehatan');
    }
}
