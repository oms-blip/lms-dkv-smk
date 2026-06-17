<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    // Mengizinkan semua kolom diisi (Mass Assignment)
    protected $guarded = [];

    // Relasi ke tabel User (Guru)
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}