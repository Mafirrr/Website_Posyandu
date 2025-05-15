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
        Schema::create('pemeriksaan_usg_awal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemeriksaan_id')->references('id')->on('pemeriksaan_kehamilan');
            $table->enum('keteraturan_haid', ['teratur', 'tidak_teratur']);
            $table->integer('umur_kehamilan_berdasar_hpht');
            $table->integer('umur_kehamilan_berdasarkan_usg');
            $table->string('hpl_berdasarkan_hpht');
            $table->string('hpl_berdasarkan_usg');
            $table->enum('jumlah_bayi', ['tunggal', 'kembar']);
            $table->enum('Jumlah_GS', ['1', '2', '3']);
            $table->float('diametes_gs');
            $table->integer('gs_hari');
            $table->integer('gs_minggu');
            $table->float('crl');
            $table->integer('crl_hari');
            $table->integer('crl_minggu');
            $table->enum('letak_produk_kehamilan', ['intrauterin', 'ekstrauterin']);
            $table->enum('pulsasi_jantung', ['ada', 'tidak_ada']);
            $table->enum('kecurigaan_temuan_abnormal', ['ya', 'tidak']);
            $table->text('keterangan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_usg_awals');
    }
};
