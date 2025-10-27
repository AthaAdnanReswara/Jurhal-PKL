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
        Schema::create('dudis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dudi', 255);
            $table->string('jenis_usaha', 255);
            $table->text('alamat');
            $table->string('no_hp', 100);
            $table->string('direktur', 255);
            $table->string('pembimbing', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dudis');
    }
};
