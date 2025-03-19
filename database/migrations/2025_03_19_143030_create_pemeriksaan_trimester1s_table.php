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
        Schema::create('pemeriksaan_trimester1', function (Blueprint $table) {
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
            $table->double('gestational_sac');
            $table->double('crown_rump_length');
            $table->integer('denyut_jantung_janin');
            $table->integer('usia_kehamilan');
            $table->boolean('kantong_kehamilan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_trimester1s');
    }
};
