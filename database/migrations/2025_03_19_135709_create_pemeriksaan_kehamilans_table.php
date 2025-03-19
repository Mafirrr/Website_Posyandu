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
        Schema::create('pemeriksaan_kehamilan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kehamilan_id')->references('id')->on('kehamilan');
            $table->foreignId('petugas_id')->references('id')->on('petugas');
            $table->date('tanggal_periksa');
            $table->string('tempat_periksa', 100);
            $table->double('berat_badan');
            $table->double('lingkar_lengan_atas');
            $table->integer('tekanan_darah_atas');
            $table->integer('tekanan_darah_bawah');
            $table->double('tinggi_rahim');
            $table->integer('denyut_jantung_janin');
            $table->string('status_imunisasi_tetanus', 50);
            $table->text('konseling');
            $table->enum('skrining_dokter', array('normal', 'tidak_normal'));
            $table->string('tambah_darah', 50);
            $table->string('usg', 50);
            $table->string('ppia', 50);
            $table->text('tata_laksana_kasus');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_kehamilans');
    }
};
