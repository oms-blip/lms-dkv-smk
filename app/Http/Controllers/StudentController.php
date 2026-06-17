<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\QuizAttempt; // Pastikan model ini sudah dibuat
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
/**
   /**
     * Menampilkan Ruang Kelas dan Daftar Materi
     */
    public function classroom($slug, Request $request)
    {
        // 1. Cukup panggil data course-nya saja (karena file PDF & Video ada di sini)
        $course = \App\Models\Course::with('quiz')->where('slug', $slug)->firstOrFail();
        
        $user = \Illuminate\Support\Facades\Auth::user();

        // Bypass syarat kuis sementara agar tidak error
        $isEligibleForQuiz = true; 
        $quiz = $course->quiz ?? null;

        return view('student.classroom', compact('course', 'isEligibleForQuiz', 'quiz'));
    }

/**
     * Fitur Tandai Selesai
     */
    public function toggleComplete($id)
    {
        // Tetap menggunakan logika yang ada, tapi ID yang dikirim sekarang adalah ID Modul
        $user = \Illuminate\Support\Facades\Auth::user();

        if (!$user->completedLessons->contains($id)) {
            $user->completedLessons()->attach($id);
            return redirect()->back()->with('success', 'Materi diselesaikan! Lanjutkan ke materi berikutnya.');
        }

        return redirect()->back();
    }

    /**
     * Menampilkan Halaman Kuis
     */
    public function showQuiz($slug)
    {
        $course = Course::with(['modules.lessons', 'quiz.questions'])->where('slug', $slug)->firstOrFail();
        $user = Auth::user();

        // 1. Cek Ulang Eligibilitas (Mencegah user iseng mengetik URL secara manual)
        $courseLessonIds = $course->modules->flatMap->lessons->pluck('id');
        $totalLessons = $courseLessonIds->count();
        $completedLessonsCount = $user->completedLessons()->whereIn('lesson_id', $courseLessonIds)->count();
        
        $isEligibleForQuiz = ($totalLessons > 0) && ($completedLessonsCount >= $totalLessons);

        if (!$isEligibleForQuiz) {
            return redirect()->route('student.classroom', $course->slug)
                             ->with('error', 'Akses ditolak! Selesaikan semua materi terlebih dahulu untuk membuka Kuis.');
        }

        // 2. Pastikan Kuis tersedia
        $quiz = $course->quiz;
        if (!$quiz || $quiz->questions->isEmpty()) {
            return redirect()->route('student.classroom', $course->slug)
                             ->with('error', 'Kuis belum tersedia atau belum ada soal.');
        }

        return view('student.quiz', compact('course', 'quiz'));
    }

    /**
     * Memproses Jawaban Kuis Siswa
     */
    public function submitQuiz(Request $request, $slug)
    {
        $course = Course::with('quiz.questions')->where('slug', $slug)->firstOrFail();
        $quiz = $course->quiz;

        // Validasi input: pastikan 'answers' adalah array
        $request->validate([
            'answers' => 'array'
        ]);

        $answers = $request->input('answers', []); // Data dari form (key: id_soal, value: opsi_jawaban)
        $totalQuestions = $quiz->questions->count();
        $correctCount = 0;

        // 1. Proses Pengecekan Jawaban
        foreach ($quiz->questions as $question) {
            // Jika user menjawab soal ini dan jawabannya cocok dengan correct_answer di database
            if (isset($answers[$question->id]) && $answers[$question->id] === $question->correct_answer) {
                $correctCount++;
            }
        }

        // 2. Hitung Nilai (Skor skala 0 - 100)
        $score = 0;
        if ($totalQuestions > 0) {
            $score = round(($correctCount / $totalQuestions) * 100);
        }

        // 3. Simpan Riwayat Kuis ke Database
        QuizAttempt::create([
            'user_id' => Auth::id(),
            'quiz_id' => $quiz->id,
            'score'   => $score,
            'answers_data' => json_encode($answers) // Opsional: Simpan detail jawaban jika ingin dievaluasi guru
        ]);

        // 4. Redirect ke Classroom dengan pesan sukses dan nilai
        return redirect()->route('student.classroom', $course->slug)
                         ->with('success', "Kuis Selesai! Anda mendapatkan skor: {$score}/100");
    }
    /**
     * Menampilkan katalog semua kelas yang tersedia untuk siswa.
     */
    public function katalog()
    {
        $courses = \App\Models\Course::with('teacher')->latest()->get();

        return view('student.katalog', compact('courses'));
    }
   /**
     * Menampilkan Halaman Daftar Tugas Siswa
     */
   /**
     * Menampilkan Halaman Daftar Tugas Siswa (OPEN ACCESS)
     */
    public function assignments()
    {
        $user = \Illuminate\Support\Facades\Auth::user();

        // 1. AMBIL SEMUA TUGAS (Tanpa peduli siswa mendaftar kelas atau tidak)
        $assignments = \App\Models\Assignment::with('course')
                        ->latest()
                        ->get();
        
        // 2. Ambil data pengumpulan (submissions) milik siswa ini
        $submissions = \App\Models\Submission::where('user_id', $user->id)
                        ->get()
                        ->keyBy('assignment_id');
        
        // 3. Hitung Metrik Tugas
        $totalTugas = $assignments->count();
        $totalSelesai = $submissions->where('status', 'Sudah Dinilai')->count();
        $totalMenunggu = $submissions->where('status', 'Menunggu')->count();
        
        // 4. Hitung tugas yang belum dikerjakan
        $totalBelum = $totalTugas - ($totalSelesai + $totalMenunggu);

        return view('student.assignments.index', compact(
            'assignments', 
            'submissions', 
            'totalBelum', 
            'totalMenunggu', 
            'totalSelesai'
        ));
    }
    /**
     * Menampilkan Detail Tugas (Deskripsi, PDF, atau Link Google Form)
     */
    public function showAssignment($id)
    {
        // Cari tugas berdasarkan ID
        $assignment = \App\Models\Assignment::with('course')->findOrFail($id);
        
        // Cari apakah siswa sudah pernah mengumpulkan tugas ini
        $submission = \App\Models\Submission::where('assignment_id', $id)
                        ->where('user_id', auth()->id())
                        ->first();

        return view('student.assignments.show', compact('assignment', 'submission'));
    }
    /**
     * Memproses Pengumpulan Tugas (Upload File / Google Form)
     */
    public function submitAssignment(Request $request, $id)
    {
        // 1. Cek dulu apakah ini tugas Google Form atau PDF
        $assignment = \App\Models\Assignment::findOrFail($id);
        
        $linkTugas = $assignment->link_url ?? $assignment->link_tugas ?? $assignment->google_form ?? null;
        $isGoogleForm = !empty($linkTugas);

        // 2. Jika BUKAN Google Form, wajibkan isi file ATAU link
        if (!$isGoogleForm) {
            $request->validate([
                'file_path' => 'required_without:link_url|nullable|file|max:5120',
                'link_url'  => 'required_without:file_path|nullable|url'
            ], [
                'file_path.required_without' => 'Hei! Kamu harus upload file atau tempel link jawaban dulu.',
                'link_url.required_without'  => 'Hei! Kamu harus upload file atau tempel link jawaban dulu.'
            ]);
        }

        // 3. Cek apakah sudah pernah ngumpul
        $existingSubmission = \App\Models\Submission::where('assignment_id', $id)
                                ->where('user_id', auth()->id())
                                ->first();

        if ($existingSubmission) {
            return redirect()->route('student.assignments')->with('error', 'Kamu sudah mengumpulkan tugas ini!');
        }

        // 4. Simpan Data ke Database
        $submission = new \App\Models\Submission();
        $submission->assignment_id = $id;
        $submission->user_id = auth()->id();
        $submission->status = 'Menunggu'; // Otomatis berstatus menunggu
        $submission->score = 0;

        if ($request->hasFile('file_path')) {
            $submission->file_path = $request->file('file_path')->store('submissions', 'public');
        }

        if ($request->filled('link_url')) {
            $submission->link_url = $request->link_url;
        }

        $submission->save();

        // 5. Kembali ke halaman tugas (Ini yang akan bikin tombol "Kerjakan" berubah)
        return redirect()->route('student.assignments')->with('success', 'Tugas berhasil dikumpulkan!');
    }
    /**
     * Menampilkan Halaman Profil Siswa Dinamis
     */
    public function profile()
    {
        $user = \Illuminate\Support\Facades\Auth::user();

        // 1. Hitung Total Tugas yang sudah dikumpulkan
        $totalTugas = \App\Models\Submission::where('user_id', $user->id)->count();

        // 2. Hitung Rata-rata Nilai (Hanya dari tugas yang sudah dinilai)
        $rataRata = \App\Models\Submission::where('user_id', $user->id)
                        ->where('status', 'Sudah Dinilai')
                        ->avg('score') ?? 0;

        // 3. Hitung Progress (Persentase Tugas Selesai vs Total Tugas Tersedia)
        // Jika pakai fitur pendaftaran kelas: $enrolledCourseIds = $user->enrolledCourses->pluck('id');
        // Tapi karena aplikasi bosku open-access, kita hitung dari semua tugas yang ada:
        $totalTugasTersedia = \App\Models\Assignment::count();
        $progress = $totalTugasTersedia > 0 ? round(($totalTugas / $totalTugasTersedia) * 100) : 0;

        return view('profile.student', compact('user', 'totalTugas', 'rataRata', 'progress'));
    }
    // 👇 Tambahan dari Jamal untuk melihat detail performa 1 siswa khusus 👇
    public function show($id)
    {
        // Cari data siswa berdasarkan ID (pastikan dia benar-benar 'student')
        $student = \App\Models\User::where('role', 'student')->findOrFail($id);

        // Ambil riwayat tugas yang sudah dikerjakan oleh siswa ini
        $submissions = \App\Models\Submission::where('user_id', $id)
                            ->with('assignment')
                            ->latest()
                            ->get();

        // Hitung statistik si siswa
        $tugasSelesai = $submissions->count();
        $rataRata = $submissions->where('status', 'Sudah Dinilai')->avg('score') ?? 0;
        
        // Kita kirim datanya ke halaman view detail siswa
        return view('teacher.students.show', compact('student', 'submissions', 'tugasSelesai', 'rataRata'));
    }
}