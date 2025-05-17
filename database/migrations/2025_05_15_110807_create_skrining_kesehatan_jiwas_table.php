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
        Schema::create('skrining_kesehatan_jiwa', function (Blueprint $table) {
            $table->id();
            $table->enum('skrining_jiwa', ['ya', 'tidak']);
            $table->enum('tindak_lanjut_jiwa', ['edukasi', 'konseling']);
            $table->enum('perlu_rujukan', ['ya', 'tidak']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skrining_kesehatan_jiwa');
    }
};
