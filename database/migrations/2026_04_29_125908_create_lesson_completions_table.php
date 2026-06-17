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
    Schema::create('lesson_completions', function (Blueprint $table) {
        $table->id();
        // Foreign key ke tabel users (Siswa)
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        // Foreign key ke tabel lessons (Materi)
        $table->foreignId('lesson_id')->constrained()->onDelete('cascade');
        
        $table->timestamps();

        // Memastikan kombinasi user dan lesson unik (tidak bisa double completion)
        $table->unique(['user_id', 'lesson_id']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_completions');
    }
};
