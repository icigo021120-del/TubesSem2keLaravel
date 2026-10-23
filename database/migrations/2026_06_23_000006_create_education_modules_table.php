<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('education_modules', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 200);
            $table->enum('kategori', ['gempa', 'kebakaran', 'banjir', 'umum'])->default('umum');
            $table->longText('konten');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('education_modules');
    }
};
