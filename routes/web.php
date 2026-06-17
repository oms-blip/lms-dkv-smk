<?php

use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\LessonController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ScheduleController;

Route::get('/', function () {
    return view('welcome');
});

// RUTE KELOLA JADWAL GURU
Route::get('/teacher/schedules', [ScheduleController::class, 'index'])->name('teacher.schedules.index');
Route::post('/teacher/schedules', [ScheduleController::class, 'store'])->name('teacher.schedules.store');
Route::delete('/teacher/schedules/{id}', [ScheduleController::class, 'destroy'])->name('teacher.schedules.destroy');

// --- RUTE GOOGLE (Di luar middleware agar bisa diakses orang yang belum login) ---
Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('google.redirect');
// Halaman Login Khusus Guru
Route::view('/login-guru', 'auth.login-guru')->name('login.guru');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('google.callback');

// --- ROUTE UMUM (Setelah Login) ---
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==========================================
// GRUP KHUSUS GURU & ADMIN (Sisanya tetap sama)
// ==========================================
Route::middleware(['auth', 'verified', 'role:admin,teacher'])->group(function () {
    Route::get('/courses/{id}/reports', [CourseController::class, 'reports'])->name('courses.reports');
    Route::get('/students', [UserController::class, 'studentsIndex'])->name('teacher.students.index');
    Route::get('/teacher/students/{id}', [StudentController::class, 'show'])->name('teacher.students.show');
    
    // ... (rute tugas dan lainnya tetap sama seperti kodingan bosku sebelumnya)
    Route::get('/teacher/tasks', [AssignmentController::class, 'index'])->name('teacher.tasks.index');
    Route::get('/teacher/tasks/create', [AssignmentController::class, 'create'])->name('teacher.tasks.create');
    Route::post('/teacher/tasks/store', [AssignmentController::class, 'store'])->name('teacher.tasks.store');
    Route::get('/teacher/tasks/{id}/edit', [AssignmentController::class, 'edit'])->name('teacher.tasks.edit');
    Route::put('/teacher/tasks/{id}', [AssignmentController::class, 'update'])->name('teacher.tasks.update');
    Route::get('/teacher/tasks/{id}', [AssignmentController::class, 'show'])->name('teacher.tasks.show');
    Route::get('/teacher/tasks/{id}/grade', [AssignmentController::class, 'grade'])->name('teacher.tasks.grade');
    Route::put('/teacher/tasks/submissions/{id}/grade', [AssignmentController::class, 'saveGrade'])->name('teacher.tasks.saveGrade');
    Route::delete('/teacher/tasks/{id}', [AssignmentController::class, 'destroy'])->name('teacher.tasks.destroy');
    Route::get('/teacher/tasks/{id}/grade/{student_id}', [AssignmentController::class, 'gradeStudent'])->name('teacher.tasks.grade.student');
    
    Route::get('/teacher/settings', function () { return view('teacher.settings.index'); })->name('teacher.settings.index');
    Route::get('/teacher/reports', [ReportController::class, 'index'])->name('teacher.reports.index');
    
    Route::resource('courses', CourseController::class);
    Route::post('/courses/{course}/modules', [ModuleController::class, 'store'])->name('modules.store');
    Route::put('/modules/{module}', [ModuleController::class, 'update'])->name('modules.update');
    Route::delete('/modules/{module}', [ModuleController::class, 'destroy'])->name('modules.destroy');
    Route::post('/modules/{module}/lessons', [LessonController::class, 'store'])->name('lessons.store');
    Route::put('/lessons/{lesson}', [LessonController::class, 'update'])->name('lessons.update');
    Route::delete('/lessons/{lesson}', [LessonController::class, 'destroy'])->name('lessons.destroy');
});

// ... (Grup siswa dan lainnya biarkan sama saja)
Route::middleware(['auth', 'verified', 'role:student,teacher,admin'])->group(function () {
    Route::get('/classroom/{slug}', [StudentController::class, 'classroom'])->name('student.classroom');
    Route::get('/classroom/{slug}/quiz', [StudentController::class, 'showQuiz'])->name('quiz.show');
    Route::post('/classroom/{slug}/quiz', [StudentController::class, 'submitQuiz'])->name('quiz.submit');
    Route::post('/lesson/{lesson_id}/complete', [StudentController::class, 'toggleComplete'])->name('lesson.complete');
});

Route::middleware(['auth', 'verified', 'role:student'])->group(function () {
    Route::get('/materi', [StudentController::class, 'katalog'])->name('student.katalog');
    Route::get('/student/classroom/{slug}/quiz', [StudentController::class, 'showQuiz'])->name('student.quiz');
    Route::post('/student/classroom/{slug}/quiz', [StudentController::class, 'submitQuiz'])->name('student.quiz.submit');
    Route::post('/student/lesson/{id}/complete', [StudentController::class, 'toggleComplete'])->name('student.lesson.complete');
    Route::get('/tugas', [StudentController::class, 'assignments'])->name('student.assignments');
    Route::get('/tugas/{id}', [StudentController::class, 'showAssignment'])->name('student.assignments.show');
    Route::post('/tugas/{id}/submit', [StudentController::class, 'submitAssignment'])->name('student.assignments.submit');
    Route::get('/my-profile', [StudentController::class, 'profile'])->name('student.profile');
});

require __DIR__ . '/auth.php';