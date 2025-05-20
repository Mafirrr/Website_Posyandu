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
        Schema::create('trimester_3', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemeriksaan_id')->unique()->constrained('pemeriksaan_kehamilan')->onDelete('cascade');
            $table->foreignId('skrining_kesehatan')->unique()->constrained('skrining_kesehatan_jiwa')->onDelete('cascade');
            $table->foreignId('pemeriksaan_fisik')->unique()->constrained('pemeriksaan_fisik')->onDelete('cascade');
            $table->foreignId('lab_trimester_3')->unique()->constrained('lab_trimester_3')->onDelete('cascade');
            $table->foreignId('usg_trimester_3')->unique()->constrained('usg_trimester_3')->onDelete('cascade');
            $table->foreignId('rencana_konsultasi')->unique()->constrained('rencana_konsultasi')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trimester3s');
    }
};
