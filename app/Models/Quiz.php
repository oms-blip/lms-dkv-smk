<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'title'];

    // Relasi balik ke Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Relasi One-to-Many ke Questions
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    // Relasi ke tabel attempts (Siswa yang mengerjakan)
    public function attempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }
}