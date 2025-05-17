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
        Schema::create('pemeriksaan_awal', function (Blueprint $table) {
            $table->id();
            $table->integer('tinggi_badan');
            $table->enum('golongan_darah', array('A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'));
            $table->enum('status_imunisasi', ['t1', 't2', 't3', 't4', 't5']);
            $table->float('hemoglobin');
            $table->json('riwayat_kesehatan_ibu_sekarang');
            $table->json('riwayat_perilaku');
            $table->json('riwayat_penyakit_keluarga');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_awal');
    }
};
