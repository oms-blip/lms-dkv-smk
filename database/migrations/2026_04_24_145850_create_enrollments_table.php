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
    Schema::create('enrollments', function (Blueprint $table) {
        $table->id();
        // Relasi ke tabel Users sebagai Siswa
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        // Relasi ke tabel Courses
        $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
        
        // Status sesuai kebutuhan sistem di proposal
        $table->enum('status', ['active', 'completed'])->default('active');
        $table->timestamps();

        // Mencegah duplikasi data (Satu siswa tidak bisa daftar kelas yang sama 2x)
        $table->unique(['user_id', 'course_id']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
