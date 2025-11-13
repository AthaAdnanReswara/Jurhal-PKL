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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_siswa')->constrained('users')->cascadeOnDelete();
            $table->string('NIS', 10)->unique();
            $table->foreignId('jurusan_id')->constrained('jurusans');
            $table->string('tempat_lahir', 255);
            $table->date('tanggal_lahir');
            $table->string('alamat', 255);
            $table->foreignId('kelas_id')->constrained('kelas');
            $table->string('golongan_darah')->nullable();
            $table->enum('jenis_kelamin',['laki-laki','perempuan','tidak diketahui']);
            $table->foreignId('nama_dudi')->constrained('dudis')->cascadeOnDelete();
            $table->foreignId('pembimbing_id')->constrained('users')->cascadeOnDelete();
            $table->string('foto', 255)->nullable();
            $table->integer('no_hp', 15)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
