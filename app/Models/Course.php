<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'title',
        'slug',
        'thumbnail',
        'description',
        'materi_pdf', // <-- Tambahan baru
        'video_link', // <-- Tambahan baru
        // (Biarkan kolom lain yang sudah ada sebelumnya)
    ];

    /**
     * Relasi ke Guru (User) yang membuat kelas
     */
    public function teacher() 
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    /**
     * Relasi ke Modul-modul di dalam kelas ini
     */
    public function modules() 
    {
        // Diurutkan berdasarkan kolom 'order' agar materi tidak berantakan
        return $this->hasMany(Module::class)->orderBy('order', 'asc');
    }

    /**
     * Relasi ke Siswa yang mendaftar (Enrollments)
     */
    public function enrolledStudents() 
    {
        // Pastikan nama tabel pivotnya adalah 'course_user' atau 'enrollments' 
        // sesuai dengan migration yang kamu buat
        return $this->belongsToMany(User::class, 'course_user')
                    ->withTimestamps();
    }

    /**
     * Relasi ke Kuis (Satu kelas hanya punya satu kuis evaluasi akhir)
     */
    public function quiz()
    {
        return $this->hasOne(Quiz::class);
    }
}