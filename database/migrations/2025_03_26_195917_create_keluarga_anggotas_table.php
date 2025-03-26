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
        Schema::create('keluarga_anggota', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->references('id')->on('anggota');
            $table->string('nik', 16)->unique();
            $table->string('nama', 70);
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir', 100);
            $table->string('pekerjaan', 100);
            $table->text('alamat');
            $table->char('no_telepon', 13)->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keluarga_anggotas');
    }
};
