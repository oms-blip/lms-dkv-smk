<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    // Menampilkan daftar kelas milik guru yang login
    public function index()
    {
        $courses = Course::where('teacher_id', auth()->id())->latest()->get();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    // Menyimpan data kelas baru ke database
    public function store(Request $request)
    {
        // 1. Validasi Inputan (Disesuaikan untuk menerima Link, bukan File Upload)
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:courses,slug',
            'thumbnail' => 'nullable|string', // Menerima Link Gambar
            'description' => 'required|string',
            'materi_pdf' => 'nullable|string', // Menerima Link Google Drive
            'video_link' => 'nullable|url', 
        ]);

        // Mengisi kolom teacher_id secara otomatis dengan ID Guru yang lagi login
        $validated['teacher_id'] = auth()->id(); 

        // 4. Simpan ke Database
        Course::create($validated);

        // 5. Kembalikan ke halaman daftar kelas dengan pesan sukses
        return redirect()->route('courses.index')->with('success', 'Kelas berhasil dibuat! Server aman sentosa!');
    }

    public function edit(Course $course)
    {
        // Pastikan guru hanya bisa mengedit kelas miliknya sendiri
        if ($course->teacher_id !== auth()->id()) abort(403);
        
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        // 1. Validasi data inputan (Disesuaikan untuk menerima Link)
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail' => 'nullable|string',
            'materi_pdf' => 'nullable|string', 
            'video_link' => 'nullable|url',
        ]);

        // 3. Update data ke database
        $course->update($validated);

        // 4. Redirect kembali ke halaman utama materi
        return redirect()->route('courses.index')->with('success', 'Materi kelas berhasil diperbarui!');
    }

    public function destroy(Course $course)
    {
        if ($course->teacher_id !== auth()->id()) abort(403);

        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Kelas berhasil dihapus!');
    }

    public function reports($id)
    {
        // 1. Ambil data Course beserta Siswa yang terdaftar dan Lesson yang telah mereka selesaikan
        $course = Course::with([
            'enrolledStudents.completedLessons', 
            'modules.lessons'
        ])->findOrFail($id);

        // 2. Hitung Total Lesson yang ada di dalam Course ini
        $totalLessons = 0;
        foreach ($course->modules as $module) {
            $totalLessons += $module->lessons->count();
        }

        // 3. Ambil ID semua lesson yang ada di course ini untuk filter perhitungan progres
        $courseLessonIds = $course->modules->flatMap->lessons->pluck('id')->toArray();

        return view('courses.reports', compact('course', 'totalLessons', 'courseLessonIds'));
    }

    public function show(Course $course)
    {
        // Eager load modules dan lessons agar muncul di halaman kelola
        $course->load('modules.lessons');
        
        return view('courses.show', compact('course'));
    }
}