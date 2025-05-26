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
        Schema::create('artikels', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 100);
            $table->string('slug', 100);
            $table->text('isi');
            $table->string('gambar', 255);
             $table->enum('kategori_edukasi', ['Kesehatan Ibu dan Janin', 'Persiapan Persalinan','Perawatan Pasca Persalinan (Postpartum)','Edukasi untuk Pasangan','Komplikasi Kehamilan', 'lainnya']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artikels');
    }
};
