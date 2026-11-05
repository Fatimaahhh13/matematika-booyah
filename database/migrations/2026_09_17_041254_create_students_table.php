<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id')->nullable(); // Kolom branch_id sesuai database
            $table->string('avatar')->nullable();
            $table->string('name');
            $table->string('school');
            $table->string('parent_name');
            $table->string('parent_phone');
            $table->string('module');
            $table->string('status')->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};