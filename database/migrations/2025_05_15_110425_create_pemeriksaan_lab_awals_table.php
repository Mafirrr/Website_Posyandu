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
        Schema::create('lab_trimester_1', function (Blueprint $table) {
            $table->id();
            $table->float('hemoglobin');
            $table->string('golongan_darah_dan_rhesus');
            $table->float('gula_darah');
            $table->string('hemoglobin_rtl')->nullable();
            $table->string('rhesus_rtl')->nullable();
            $table->string('gula_darah_rtl')->nullable();
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
        Schema::dropIfExists('lab_trimester_1');
    }
};
