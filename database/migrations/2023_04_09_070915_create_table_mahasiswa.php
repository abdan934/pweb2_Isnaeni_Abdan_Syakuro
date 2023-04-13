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
        Schema::create('table_mahasiswa', function (Blueprint $table) {
            $table->timestamps();
            // $table->id();
            $table->string('nim');
            $table->string('nama_mhs');
            $table->string('email');
            $table->string('jurusan');
            $table->primary('nim');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_mahasiswa');
    }
};
