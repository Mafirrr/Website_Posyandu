<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nifas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->references('id')->on('anggota');
            $table->foreignId('petugas_id')->references('id')->on('petugas');
            $table->date('tanggal_pemeriksaan');
            $table->string('tempat_pemeriksaan');
            $table->text('periksa_payudara');
            $table->text('periksa_pendarahan');
            $table->text('periksa_jalan_lahir');
            $table->text('vitamin_a');
            $table->text('kb_pasca_melahirkan');
            $table->text('skrining_kesehatan_jiwa');
            $table->text('konseling');
            $table->text('tata_laksana_kasus');
            $table->string('kesimpulan_ibu');
            $table->string('kesimpulan_bayi');
            $table->string('masalah_nifas');
            $table->text('kesimpulan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nifas');
    }
};
