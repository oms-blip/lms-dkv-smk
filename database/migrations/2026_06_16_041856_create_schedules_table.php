<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            // Menyimpan ID Guru yang membuat jadwal
            $table->foreignId('teacher_id')->constrained('users')->cascadeOnDelete();
            
            $table->string('day'); // Contoh: Senin, Selasa
            $table->time('start_time'); // Contoh: 08:00
            $table->time('end_time')->nullable(); // Contoh: 10:00
            $table->string('title'); // Contoh: Tipografi Lanjutan
            $table->string('room'); // Contoh: Ruang Teori / Link Meet
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('schedules');
    }
};