<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Module;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Support\Str;

class DkvCourseSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil guru pertama (Pastikan kamu sudah menjalankan DatabaseSeeder sebelumnya)
        $teacher = User::where('role', 'teacher')->first();

        if (!$teacher) {
            return;
        }

        // 1. Injeksi Course
        $course = Course::create([
            'teacher_id' => $teacher->id,
            'title' => 'Pengembangan Platform Belajar Digital Berbasis Web untuk Kelas X DKV SMKN Kebonagung',
            'slug' => Str::slug('Pengembangan Platform Belajar Digital Berbasis Web untuk Kelas X DKV SMKN Kebonagung'),
            'description' => 'Mata pelajaran ini berfokus pada penguasaan elemen rupa dan prinsip dasar desain menggunakan perangkat lunak digital.',
            'thumbnail' => null, // Bisa diisi manual lewat web nanti
        ]);

        // 2. Module 1: Prinsip Dasar Layout
        $module1 = Module::create([
            'course_id' => $course->id,
            'title' => 'Eksperimen Komposisi dan Tata Letak',
            'order' => 1,
        ]);

        Lesson::create([
            'module_id' => $module1->id,
            'title' => 'Penerapan Rule of Thirds pada Desain Poster',
            'content' => 'Instruksi Praktik: Buatlah grid 3x3 di atas kanvas digital Anda. Tempatkan objek utama pada titik potong garis grid untuk menciptakan keseimbangan asimetris yang dinamis.',
            'order' => 1,
        ]);

        Lesson::create([
            'module_id' => $module1->id,
            'title' => 'Eksplorasi White Space dalam Desain Antarmuka',
            'content' => 'Teknis: Gunakan jarak minimal 24px antar elemen visual untuk memberikan ruang nafas pada desain, sehingga informasi utama lebih mudah terbaca oleh audiens.',
            'order' => 2,
        ]);

        // 3. Module 2: Tipografi Digital
        $module2 = Module::create([
            'course_id' => $course->id,
            'title' => 'Teknik Tipografi dan Hierarki Visual',
            'order' => 2,
        ]);

        Lesson::create([
            'module_id' => $module2->id,
            'title' => 'Pemilihan Font Pairings untuk Kebutuhan Vektor',
            'content' => 'Instruksi: Kombinasikan satu font Serif untuk judul dan satu font Sans-Serif untuk teks tubuh. Pastikan tingkat kontras ketebalan (weight) terlihat jelas.',
            'order' => 1,
        ]);

        Lesson::create([
            'module_id' => $module2->id,
            'title' => 'Praktik Kerning dan Leading pada Teks Panjang',
            'content' => 'Teknis: Atur nilai leading sebesar 120% dari ukuran font untuk meningkatkan keterbacaan teks deskripsi pada karya desain komunikasi visual Anda.',
            'order' => 2,
        ]);
    }
}