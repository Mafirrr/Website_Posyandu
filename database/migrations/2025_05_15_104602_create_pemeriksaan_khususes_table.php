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
        Schema::create('pemeriksaan_khusus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemeriksaan_id')->references('id')->on('pemeriksaan_kehamilan');
            $table->enum('porsio', ['normal', 'tidak_normal']);
            $table->enum('uretra', ['normal', 'tidak_normal']);
            $table->enum('vagina', ['normal', 'tidak_normal']);
            $table->enum('vulva', ['normal', 'tidak_normal']);
            $table->enum('fluksus', ['positif', 'negatif']);
            $table->enum('fluor', ['positif', 'negatif']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_khusus');
    }
};
