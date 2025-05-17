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
        Schema::create('usg_trimester_3', function (Blueprint $table) {
            $table->id();
            $table->enum('usg_trimester3', ['ya', 'tidak']);
            $table->float('umur_kehamilan_usg_trimester_3');
            $table->enum('selisih_uk_usg_1_hpht_dengan_trimester_3', ['ya', 'tidak']);
            $table->enum('jumlah_bayi', ['tunggal', 'kembar']);
            $table->enum('letak_bayi', ['intrauterin', 'extrauterin', 'tidak_dapat_ditentukan']);
            $table->enum('presentasi_bayi', ['kepala', 'bokong', 'letak_lintang']);
            $table->enum('keadaan_bayi', ['hidup', 'maninggal']);
            $table->enum('djj_status', ['normal', 'tidak_normal']);
            $table->enum('lokasi_plasenta', ['letak_rendah', 'corpus', 'fundus', 'previa']);
            $table->enum('jumlah_cairan_ketuban', ['cukup', 'kurang', 'berlebih']);
            $table->float('djj')->nullable();
            $table->float('sdp')->nullable();
            $table->float('BPD');
            $table->float('HC');
            $table->float('AC');
            $table->float('FL');
            $table->float('EFW');
            $table->integer('HC_Sesuai_Minggu');
            $table->integer('BPD_Sesuai_Minggu');
            $table->integer('AC_Sesuai_Minggu');
            $table->integer('FL_Sesuai_Minggu');
            $table->integer('EFW_Sesuai_Minggu');
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
        Schema::dropIfExists('usg_trimester_3');
    }
};
