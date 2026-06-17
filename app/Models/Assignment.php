<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    // 👇 INI KUNCI PENYEMBUHANNYA BOS, WAJIB SAMA PERSIS DENGAN DB 👇
    protected $fillable = [
        'course_id',
        'title',
        'description',
        'deadline',
    ];

    // Relasi ke Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Relasi ke Submission
    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
    
}