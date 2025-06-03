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
        Schema::create('usg_trimester_1', function (Blueprint $table) {
            $table->id();
            $table->string('hpht')->nullable();
            $table->enum('keteraturan_haid', ['teratur', 'tidak_teratur']);
            $table->integer('umur_kehamilan_berdasar_hpht');
            $table->integer('umur_kehamilan_berdasarkan_usg');
            $table->string('hpl_berdasarkan_hpht')->nullable();
            $table->string('hpl_berdasarkan_usg')->nullable();
            $table->enum('jumlah_bayi', ['tunggal', 'kembar']);
            $table->enum('jumlah_gs', ['tunggal', 'kembar',]);
            $table->float('diametes_gs');
            $table->integer('gs_hari');
            $table->integer('gs_minggu');
            $table->float('crl');
            $table->integer('crl_hari');
            $table->integer('crl_minggu');
            $table->enum('letak_produk_kehamilan', ['intrauterin', 'extrauterin', 'tidak_dapat_ditentukan']);
            $table->enum('pulsasi_jantung', ['tampak', 'tidak_tampak']);
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
        Schema::dropIfExists('usg_trimester_1');
    }
};
