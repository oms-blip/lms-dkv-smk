<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\User;
use App\Models\Assignment;
use App\Models\Submission;
use App\Models\Schedule;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // =========================================================
        // 1. DATA DINAMIS UNTUK GURU / ADMIN
        // =========================================================
        if ($user->role === 'teacher' || $user->role === 'admin') {
            
            $totalStudents = User::where('role', 'student')->count();
            $activeCoursesCount = Course::where('teacher_id', $user->id)->count(); 
            $courseIds = Course::where('teacher_id', $user->id)->pluck('id');

            $pendingTasksCount = Submission::whereHas('assignment', function($q) use ($courseIds) {
                $q->whereIn('course_id', $courseIds);
            })->where('status', 'Menunggu')->count();

            $averageStudentScore = Submission::whereHas('assignment', function($q) use ($courseIds) {
                $q->whereIn('course_id', $courseIds);
            })->where('status', 'Sudah Dinilai')->avg('score');
            
            $averageStudentScore = round($averageStudentScore ?? 0); 
            $activeStudentsToday = 0; 
            
            $recentSubmissions = Submission::whereHas('assignment', function($q) use ($courseIds) {
                $q->whereIn('course_id', $courseIds);
            })->with(['student', 'assignment'])->latest()->take(5)->get();

            $namaHari = [
                'Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa',
                'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'
            ];
            $hariInggris = \Carbon\Carbon::now()->timezone('Asia/Jakarta')->format('l');
            $hariIni = $namaHari[$hariInggris]; 

            $todaySchedules = Schedule::where('teacher_id', $user->id)
                ->where('day', $hariIni)
                ->orderBy('start_time')
                ->get();
            
            return view('dashboard.teacher', compact(
                'user', 'totalStudents', 'activeCoursesCount', 'pendingTasksCount', 
                'averageStudentScore', 'activeStudentsToday', 'recentSubmissions', 'todaySchedules'
            ));
        }

        // =========================================================
        // 2. DATA DINAMIS UNTUK SISWA (UDAH NGGAK DUMMY LAGI)
        // =========================================================
        
        $courses = Course::latest()->get(); 
        $activeCoursesCount = $courses->count();

        // Trik Aman: Ngecek nama kolom relasi siswa lu (apakah pakai user_id atau student_id)
        $studentColumn = \Illuminate\Support\Facades\Schema::hasColumn('submissions', 'student_id') ? 'student_id' : 'user_id';

        // 1. Hitung Tugas yang SUDAH DINILAI (Selesai)
        $completedTasksCount = Submission::where($studentColumn, $user->id)
                                         ->where('status', 'Sudah Dinilai')
                                         ->count();

        // 2. Hitung Rata-rata Nilai Siswa
        $averageScore = Submission::where($studentColumn, $user->id)
                                  ->where('status', 'Sudah Dinilai')
                                  ->avg('score');
        $averageScore = round($averageScore ?? 0);

        // 3. Hitung Persentase Keseluruhan (Tugas Selesai dibagi Total Semua Tugas)
        $totalAssignments = Assignment::count();
        $overallProgress = 0;
        if ($totalAssignments > 0) {
            $overallProgress = round(($completedTasksCount / $totalAssignments) * 100);
        }

        // 4. Simulasi Jam Belajar (Misal: 1 Tugas Selesai = Dihitung 2 Jam Belajar)
        $learningHours = $completedTasksCount * 2;

        // 5. Tarik Jadwal Hari Ini
        $namaHari = [
            'Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'
        ];
        $hariInggris = \Carbon\Carbon::now()->timezone('Asia/Jakarta')->format('l');
        $hariIni = $namaHari[$hariInggris]; 

        $todaySchedules = Schedule::where('day', $hariIni)->orderBy('start_time')->get();

        // 6. Tarik 2 Tugas Terbaru
        try {
            $latestTasks = Assignment::latest()->take(2)->get();
        } catch (\Exception $e) {
            $latestTasks = collect([]);
        }

        return view('dashboard.student', compact(
            'user', 'courses', 'activeCoursesCount', 'completedTasksCount', 
            'averageScore', 'overallProgress', 'latestTasks', 'todaySchedules', 'learningHours'
        ));
    }
}