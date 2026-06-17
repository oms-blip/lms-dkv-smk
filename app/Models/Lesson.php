<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'title',
        'content',
        'video_url',
        'order',
    ];

    /**
     * Relasi ke Module
     */
    public function module() 
    {
        return $this->belongsTo(Module::class);
    }

    /**
     * Relasi untuk melacak siswa yang sudah menyelesaikan materi ini
     */
    public function completedBy()
    {
        return $this->belongsToMany(User::class, 'lesson_completions', 'lesson_id', 'user_id')
                    ->withTimestamps();
    }

    /**
     * Accessor untuk mengubah URL YouTube biasa menjadi URL Embed secara otomatis.
     * Digunakan di View: $lesson->embed_url
     */
    public function getEmbedUrlAttribute()
    {
        if (!$this->video_url) return null;

        // Regex untuk mengambil ID video dari berbagai format link YouTube
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $this->video_url, $match);
        
        $id = $match[1] ?? null;

        if ($id) {
            // Mengembalikan format link yang diizinkan untuk iframe
            return "https://www.youtube.com/embed/{$id}";
        }

        return null;
    }
}