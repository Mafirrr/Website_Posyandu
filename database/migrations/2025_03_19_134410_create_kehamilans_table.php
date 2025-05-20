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
        Schema::create('kehamilan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->references('id')->on('anggota');
            $table->enum('status', array('dalam_pemantauan', 'keguguran', 'berhasil'))->default('dalam_pemantauan');
            $table->integer('tahun')->nullable();
            $table->float('berat_badan_bayi')->nullable();
            $table->string('proses_melahirkan')->nullable();
            $table->string('penolong')->nullable();
            $table->string('masalah')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kehamilans');
    }
};
