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
        Schema::create('rencana_konsultasi', function (Blueprint $table) {
            $table->id();
            $table->enum('rencana_konsultasi_lanjut', ['spesialis', 'psikolog', 'lainnya']);
            $table->enum('rencana_proses_melahirkan', ['puskesmas', 'rumah_sakit', 'bidan', 'lainnya']);
            $table->enum('pilihan_kontrasepsi', ['implant', 'pil', 'suntik', 'iud', 'kondom', 'lainnya']);
            $table->enum('kebutuhan_konseling', ['ya', 'tidak']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rencana_konsultasi');
    }
};
