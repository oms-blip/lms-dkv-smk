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
    Schema::create('submissions', function (Blueprint $table) {
        $table->id();
        // Relasi ke tugas yang mana
        $table->foreignId('assignment_id')->constrained()->onDelete('cascade');
        // Relasi ke siswa siapa yang mengumpulkan
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
        
        // File yang dikumpulkan siswa (PDF/JPG dll)
        $table->string('file_path')->nullable(); 
        // Link opsional (jika siswa kumpul link Google Drive dll)
        $table->string('link_url')->nullable(); 
        
        // Status dan Nilai
        $table->enum('status', ['Menunggu', 'Sudah Dinilai'])->default('Menunggu');
        $table->integer('score')->nullable();
        $table->text('feedback')->nullable();
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
