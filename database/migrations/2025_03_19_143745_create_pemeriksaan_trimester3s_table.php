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
        Schema::create('pemeriksaan_trimester3', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kehamilan_id')->references('id')->on('kehamilan');
            $table->foreignId('petugas_id')->references('id')->on('petugas');
            $table->date('tanggal_pemeriksaan');
            $table->enum('konjungtiva', array('normal', 'tidak_normal'));
            $table->enum('sklera', array('normal', 'tidak_normal'));
            $table->enum('kulit', array('normal', 'tidak_normal'));
            $table->enum('leher', array('normal', 'tidak_normal'));
            $table->enum('gigi_mulut', array('normal', 'tidak_normal'));
            $table->enum('tht', array('normal', 'tidak_normal'));
            $table->enum('jantung', array('normal', 'tidak_normal'));
            $table->enum('paru', array('normal', 'tidak_normal'));
            $table->enum('perut', array('normal', 'tidak_normal'));
            $table->enum('tungkai', array('normal', 'tidak_normal'));
            $table->enum('janin', array('normal', 'tidak_normal'));
            $table->enum('jumlah_janin', array('normal', 'tidak_normal'));
            $table->enum('letak_janin', array('normal', 'tidak_normal'));
            $table->double('berat_janin');
            $table->enum('plasenta', array('normal', 'tidak_normal'));
            $table->integer('usia_kehamilan');
            $table->double('protein_urine');
            $table->enum('urine_produksi', array('normal', 'tidak_normal'));
            $table->enum('rencana_konsultasi_lanjut', array('normal', 'tidak_normal'));
            $table->enum('rencana_persalinan', array('normal', 'tidak_normal'));
            $table->enum('rencana_kontrasepsi', array('normal', 'tidak_normal'));
            $table->enum('konseling', array('normal', 'tidak_normal'));
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_trimester3s');
    }
};
