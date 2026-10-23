<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->text('deskripsi_kejadian');
            $table->string('lokasi_kejadian', 150);
            $table->enum('status_laporan', ['menunggu', 'diproses', 'selesai', 'palsu'])->default('menunggu');
            $table->string('foto_bukti')->nullable();
            $table->timestamp('waktu_lapor')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
