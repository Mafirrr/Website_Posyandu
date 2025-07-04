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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->nullable()->constrained('anggota')->onDelete('set null');
            $table->string('judul');
            $table->date('tanggal');
            $table->string('keterangan')->nullable();
            $table->string('lokasi');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->json('yang_menghadiri');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
