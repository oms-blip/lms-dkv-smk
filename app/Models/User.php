<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
 protected $fillable = [
        'name',
        'email',
        'password',
        'role', // (Ini kalau bosku pakai role)
        'phone',    // TAMBAHAN BARU
        'address',  // TAMBAHAN BARU
        'google_id',
        'kelas',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // Seorang Guru bisa memiliki banyak Course
    public function teacherCourses() {
        return $this->hasMany(Course::class, 'teacher_id');
    }

    // Seorang Siswa bisa mendaftar di banyak Course (Many-to-Many)
    public function enrolledCourses() {
        return $this->belongsToMany(Course::class, 'enrollments')
                    ->withPivot('status')
                    ->withTimestamps();
    }
    public function completedLessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_completions', 'user_id', 'lesson_id')
                    ->withTimestamps();
    }
    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }
    public function studentsIndex()
    {
        // Sementara kita return view dulu, nanti datanya bisa ditarik dari database User dengan role 'student'
        return view('students.index');
    }
// 👇 Tambahkan kode ini supaya User (Siswa) bisa mengenali tugas yang dia kumpulkan
    public function submissions()
    {
        return $this->hasMany(\App\Models\Submission::class);
    }
}
