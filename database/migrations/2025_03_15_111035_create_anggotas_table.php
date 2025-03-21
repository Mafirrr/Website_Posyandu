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
        Schema::create('anggota', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16);
            $table->string('password');
            $table->string('nama', 70);
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir', 100);
            $table->string('pekerjaan', 100);
            $table->text('alamat');
            $table->char('no_telepon', 13);
            $table->enum('golongan_darah', array('A', 'B', 'AB', 'O'));
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->references('id')->on('anggota')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota');
    }
};
