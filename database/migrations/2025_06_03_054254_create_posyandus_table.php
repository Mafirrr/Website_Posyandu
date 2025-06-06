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
        Schema::create('posyandu', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100)->unique();
            $table->string('alamat')->nullable();
            $table->timestamps();
        });

        Schema::table('anggota', function (Blueprint $table) {
            $table->foreignId('posyandu_id')->after('alamat')->constrained('posyandu')->onDelete('cascade');
        });

        Schema::table('pemeriksaan_kehamilan', function (Blueprint $table) {
            $table->dropColumn('tempat_pemeriksaan');
        });

        Schema::table('pemeriksaan_kehamilan', function (Blueprint $table) {
            $table->foreignId('tempat_pemeriksaan')->after('tanggal_pemeriksaan')->constrained('posyandu')->onDelete('cascade');
        });

        Schema::table('jadwal', function (Blueprint $table) {
            $table->dropColumn('lokasi');
        });

        Schema::table('jadwal', function (Blueprint $table) {
            $table->foreignId('lokasi')->after('keterangan')->constrained('posyandu')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posyandus');
    }
};
