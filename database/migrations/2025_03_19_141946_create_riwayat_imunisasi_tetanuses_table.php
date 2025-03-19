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
        Schema::create('riwayat_imunisasi_tetanus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->references('id')->on('anggota');
            $table->date('tanggal_pemberian');
            $table->string('dosis', 50);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_imunisasi_tetanuses');
    }
};
