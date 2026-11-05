<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul Modul (misal: "Matematika Dasar SD")
            $table->string('grade'); // Tingkat/Kelas (misal: "Kelas 4 SD", "Kelas 9 SMP")
            $table->text('description')->nullable(); // Deskripsi Singkat Modul
            $table->string('file_path')->nullable(); // File PDF / Modul
            $table->string('cover')->nullable(); // Kolom cover diletakkan sesuai urutan di database[cite: 10]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};