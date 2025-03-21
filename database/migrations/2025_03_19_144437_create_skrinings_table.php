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
        Schema::create('skrining', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kehamilan_id')->constrained('kehamilan');
            $table->boolean('multipara_pasangan_baru')->default(false);
            $table->boolean('kehamilan_teknologi')->default(false);
            $table->boolean('umur_35_keatas')->default(false);
            $table->boolean('multipara_jarak_10_tahun_keatas')->default(false);
            $table->boolean('riwayat_preeklampsia')->default(false);
            $table->boolean('multipara_riwayat_preeklampsia')->default(false);
            $table->boolean('multipel_kehamilan')->default(false);
            $table->boolean('diabetes')->default(false);
            $table->boolean('hipertensi_kronis')->default(false);
            $table->boolean('penyakit_ginjal')->default(false);
            $table->boolean('autonium_sle')->default(false);
            $table->boolean('anti_phospholipid_syndrome')->default(false);
            $table->boolean('pemeriksaan_fisik')->default(false);
            $table->boolean('mean_arterial_pressure')->default(false);
            $table->boolean('proteinuria')->default(false);
            $table->boolean('obesitas_sebelum_hamil')->default(false);
            $table->enum('status_risiko', ['rendah', 'sedang', 'tinggi'])->default('rendah');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skrinings');
    }
};
