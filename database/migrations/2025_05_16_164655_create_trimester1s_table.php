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
        Schema::create('trimester_1', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemeriksaan_id')->unique()->constrained('pemeriksaan_kehamilan')->onDelete('cascade');
            $table->foreignId('skrining_kesehatan')->unique()->constrained('skrining_kesehatan_jiwa')->onDelete('cascade');
            $table->foreignId('pemeriksaan_fisik')->unique()->constrained('pemeriksaan_fisik')->onDelete('cascade');
            $table->foreignId('pemeriksaan_awal')->unique()->constrained('pemeriksaan_awal')->onDelete('cascade');
            $table->foreignId('pemeriksaan_khusus')->unique()->constrained('pemeriksaan_khusus')->onDelete('cascade');
            $table->foreignId('lab_trimester_1')->unique()->constrained('lab_trimester_1')->onDelete('cascade');
            $table->foreignId('usg_trimester_1')->unique()->constrained('usg_trimester_1')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trimester1s');
    }
};
