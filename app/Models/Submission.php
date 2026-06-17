<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignment_id', 'user_id', 'file_path', 'link_url', 'status', 'score', 'feedback'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Tugas Induknya
    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    // Relasi ke Siswa (User)
    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}