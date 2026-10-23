<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evacuation_routes', function (Blueprint $table) {
            $table->id();
            $table->string('nama_rute', 150);
            $table->string('lokasi_asal', 150);
            $table->string('titik_kumpul', 150);
            $table->text('deskripsi')->nullable();
            $table->integer('jarak_meter')->default(0);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evacuation_routes');
    }
};
