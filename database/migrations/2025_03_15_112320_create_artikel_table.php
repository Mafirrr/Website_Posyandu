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
            // $table->enum('Kategori_edukasi', array('kesehata', 'sosial', 'lainnya'));
             $table->enum('kategori_edukasi', ['kesehatan', 'sosial', 'lainnya']);
            // $table->foreignId('kategori_id')->references('id')->on('kategori');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikels');
    }
};
