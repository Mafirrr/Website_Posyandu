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
        Schema::create('pemeriksaan_lab_kehamilan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemeriksaan_kehamilan_id')->references('id')->on('pemeriksaan_kehamilan');
            $table->double('hemogoblin');
            $table->double('gula_darah');
            $table->string('protein_urine', 50);
            $table->string('hepatitis_b', 50);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_lab_kehamilans');
    }
};
