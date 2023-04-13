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
        Schema::create('table_nilai', function (Blueprint $table) {
            $table->timestamps();
            $table->id('no_nilai');
            $table->string('nim');
            $table->string('id_matkul');
            $table->string('angka');
            $table->string('predikat');
            $table->string('tahun_ajaran');
            $table->string('semester');
            $table->foreign('nim')->references('nim')->on('table_mahasiswa');
            $table->foreign('id_matkul')->references('id_matkul')->on('table_matkul');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_nilai');
    }
};
