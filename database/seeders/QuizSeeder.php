<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Course;

class QuizSeeder extends Seeder
{
    public function run()
    {
        // Ambil kelas pertama yang ada
        $course = Course::first();

        if ($course) {
            // Buat Kuis
            $quiz = Quiz::create([
                'course_id' => $course->id,
                'title' => 'Ujian Akhir Semester ' . $course->title,
            ]);

            // Buat Soal
            Question::create([
                'quiz_id' => $quiz->id,
                'question_text' => 'Unsur visual yang paling dasar dalam desain adalah...',
                'option_a' => 'Garis',
                'option_b' => 'Warna',
                'option_c' => 'Titik',
                'option_d' => 'Bidang',
                'correct_answer' => 'c',
            ]);
        }
    }
}