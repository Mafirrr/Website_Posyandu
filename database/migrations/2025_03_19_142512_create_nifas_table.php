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
            $table->boolean('periksa_payudara');
            $table->boolean('periksa_pendarahan');
            $table->boolean('periksa_jalan_lahir');
            $table->boolean('vitamin_a');
            $table->boolean('kb_pasca_persalinan');
            $table->text('konseling');
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
        Schema::dropIfExists('nifas');
    }
};
