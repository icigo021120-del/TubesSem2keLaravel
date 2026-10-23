<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assembly_points', function (Blueprint $table) {
            $table->id();
            $table->string('nama_titik', 150);
            $table->string('lokasi', 200);
            $table->integer('kapasitas')->default(0);
            $table->text('deskripsi')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assembly_points');
    }
};
