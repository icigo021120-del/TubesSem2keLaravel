<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sensors', function (Blueprint $table) {
            $table->id();
            $table->string('kode_sensor', 50)->unique();
            $table->enum('jenis_sensor', ['asap', 'api', 'gempa', 'banjir']);
            $table->string('lokasi_gedung', 100);
            $table->enum('status', ['aktif', 'rusak', 'maintenance'])->default('aktif');
            $table->timestamp('last_checked')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sensors');
    }
};
