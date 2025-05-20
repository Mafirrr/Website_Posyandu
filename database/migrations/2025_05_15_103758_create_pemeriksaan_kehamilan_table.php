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
            $table->date('tanggal_pemeriksaan');
            $table->string('tempat_pemeriksaan')->nullable();
            $table->enum('jenis_pemeriksaan', ['trimester1', 'trimester2', 'trimester3', 'nifas']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_kehamilan');
    }
};
