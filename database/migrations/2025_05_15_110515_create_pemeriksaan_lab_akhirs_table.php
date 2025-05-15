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
        Schema::create('pemeriksaan_lab_akhir', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemeriksaan_id')->references('id')->on('pemeriksaan_kehamilan');
            $table->float('Hemoglobin');
            $table->float('Protein_urin');
            $table->enum('urin_reduksi', ['negatif', '+1', '+2', '+3', '+4']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_lab_akhir');
    }
};
