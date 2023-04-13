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
        Schema::create('table_matkul', function (Blueprint $table) {
            $table->primary('id_matkul');
            $table->foreign('nidn')->references('nidn')->on('table_dosen');
            $table->string('nidn');
            $table->string('nama_matkul');
            $table->timestamps();
            // $table->string('id_matkul');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_matkul');
    }
};
