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
            $table->string('nik', 16)->unique();
            $table->string('password');
            $table->string('nama', 70);
            $table->enum('role', ['ibu_hamil', 'kader', 'ibu_hamil_kader'])->default('ibu_hamil');
            $table->string('no_jkn', 13)->unique()->nullable();
            $table->string('faskes_tk1', 100)->nullable();
            $table->string('faskes_rujukan', 100)->nullable();
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir', 100);
            $table->string('pekerjaan', 100);
            $table->text('alamat');
            $table->char('no_telepon', 16)->unique();
            $table->enum('golongan_darah', array('A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'))->nullable();
            $table->boolean('aktif')->default(true);
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
            $table->foreignId('user_id')->nullable();
            $table->string('user_type')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
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
