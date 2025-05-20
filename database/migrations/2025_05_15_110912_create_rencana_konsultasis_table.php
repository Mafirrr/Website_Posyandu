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
            $table->json('rencana_konsultasi_lanjut')->nullable();
            $table->enum('rencana_proses_melahirkan', ['normal', 'pervaginam_berbantu', 'sectio_caesaria'])->nullable();
            $table->enum('pilihan_kontrasepsi', ['AKDR', 'Pil', 'Suntik', 'Steril', 'MAL', 'Implan', 'belum_memilih'])->nullable();
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
