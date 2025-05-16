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
        Schema::create('pemeriksaan_fisik', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemeriksaan_id')->references('id')->on('pemeriksaan_kehamilan');
            $table->enum('konjungtiva', ['Anemia', 'tidak_anemia']);
            $table->enum('sklera', ['ikterik', 'tidak_ikterik']);
            $table->enum('leher', ['normal', 'tidak_normal']);
            $table->enum('kulit', ['normal', 'tidak_normal']);
            $table->enum('gigi_mulut', ['normal', 'tidak_normal']);
            $table->enum('tht', ['normal', 'tidak_normal']);
            $table->enum('jantung', ['normal', 'tidak_normal']);
            $table->enum('paru', ['normal', 'tidak_normal']);
            $table->enum('perut', ['normal', 'tidak_normal']);
            $table->enum('tungkai', ['normal', 'tidak_normal']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_fisik');
    }
};
