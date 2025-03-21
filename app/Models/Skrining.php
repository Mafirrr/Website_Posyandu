<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skrining extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'skrining';

    protected $fillable = [
        'kehamilan_id',
        'multipara_pasangan_baru',
        'kehamilan_teknologi',
        'umur_35_keatas',
        'multipara_jarak_10_tahun_keatas',
        'riwayat_preeklampsia',
        'multipara_riwayat_preeklampsia',
        'multipel_kehamilan',
        'diabetes',
        'hipertensi_kronis',
        'penyakit_ginjal',
        'autonium_sle',
        'anti_phospholipid_syndrome',
        'pemeriksaan_fisik',
        'mean_arterial_pressure',
        'proteinuria',
        'obesitas_sebelum_hamil',
        'status_risiko',
    ];

    protected $casts = [
        'multipara_pasangan_baru' => 'boolean',
        'kehamilan_teknologi' => 'boolean',
        'umur_35_keatas' => 'boolean',
        'multipara_jarak_10_tahun_keatas' => 'boolean',
        'riwayat_preeklampsia' => 'boolean',
        'multipara_riwayat_preeklampsia' => 'boolean',
        'multipel_kehamilan' => 'boolean',
        'diabetes' => 'boolean',
        'hipertensi_kronis' => 'boolean',
        'penyakit_ginjal' => 'boolean',
        'autonium_sle' => 'boolean',
        'anti_phospholipid_syndrome' => 'boolean',
        'pemeriksaan_fisik' => 'boolean',
        'mean_arterial_pressure' => 'boolean',
        'proteinuria' => 'boolean',
        'obesitas_sebelum_hamil' => 'boolean',
    ];


    private $risiko_sedang = [
        'multipara_pasangan_baru',
        'kehamilan_teknologi',
        'umur_35_keatas',
        'multipara_jarak_10_tahun_keatas',
        'riwayat_preeklampsia',
        'obesitas_sebelum_hamil'
    ];

    private $risiko_tinggi = [
        'multipara_riwayat_preeklampsia',
        'multipel_kehamilan',
        'diabetes',
        'hipertensi_kronis',
        'penyakit_ginjal',
        'autonium_sle',
        'anti_phospholipid_syndrome',
        'mean_arterial_pressure',
        'proteinuria',
    ];


    protected static function boot()
    {
        parent::boot();

        static::saving(function ($skrining) {
            $skrining->status_risiko = $skrining->tentukanRisiko();
        });
    }


    public function tentukanRisiko()
    {
        $jumlah_sedang = collect($this->risiko_sedang)->sum(fn($item) => $this->$item ? 1 : 0);
        $jumlah_tinggi = collect($this->risiko_tinggi)->sum(fn($item) => $this->$item ? 1 : 0);

        if ($jumlah_tinggi >= 1) {
            return 'tinggi';
        } elseif ($jumlah_sedang >= 2) {
            return 'sedang';
        } else {
            return 'rendah';
        }
    }


    public function kehamilan()
    {
        return $this->belongsTo(Kehamilan::class);
    }
}
