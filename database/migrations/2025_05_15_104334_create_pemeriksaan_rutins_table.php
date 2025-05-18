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
        Schema::create('pemeriksaan_rutin', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemeriksaan_id')->references('id')->on('pemeriksaan_kehamilan');
            $table->float('berat_badan');
            $table->string('tinggi_rahim');
            $table->integer('tekanan_darah_sistol');
            $table->integer('tekanan_darah_diastol');
            $table->string('letak_dan_denyut_nadi_bayi');
            $table->float('lingkar_lengan_atas');
            $table->string('tes_lab_gula_darah')->nullable();
            $table->string('protein_urin')->nullable();
            $table->string('tablet_tambah_darah')->nullable();
            $table->string('konseling')->nullable();
            $table->string('skrining_dokter')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_rutin');
    }
};
