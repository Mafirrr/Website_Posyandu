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
        Schema::create('pemeriksaan_lab_awal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemeriksaan_id')->references('id')->on('pemeriksaan_kehamilan');
            $table->float('hemogoblin');
            $table->string('golongan_darah_dan_rhesus');
            $table->float('gula_darah');
            $table->enum('hiv', ['reaktif', 'nonreaktif']);
            $table->enum('sifilis', ['reaktif', 'nonreaktif']);
            $table->enum('hepatitis_b', ['reaktif', 'nonreaktif']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_lab_awal');
    }
};
