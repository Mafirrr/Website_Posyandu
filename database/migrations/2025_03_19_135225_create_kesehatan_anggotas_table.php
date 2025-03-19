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
        Schema::create('kesehatan_anggota', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->references('id')->on('anggota');
            $table->integer('tinggi_badan');
            $table->double('berat_badan');
            $table->integer('tekanan_darah_sistolik');
            $table->integer('tekanan_darah_diastolik');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kesehatan_anggotas');
    }
};
