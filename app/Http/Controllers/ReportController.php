<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Submission;

class ReportController extends Controller
{
    public function index()
    {
        // 1. Data Atas
        $totalSiswa = User::where('role', 'student')->count();
        $modulSelesai = Course::count(); 

        // Mengambil HANYA tugas yang sudah diberi nilai
        $semuaDinilai = Submission::where('status', 'Sudah Dinilai')->whereNotNull('score')->get();
        $totalDinilai = $semuaDinilai->count() > 0 ? $semuaDinilai->count() : 1; 

        // Menghitung Rata-rata Nilai Asli
        $rataRataNilai = $semuaDinilai->count() > 0 ? round($semuaDinilai->avg('score')) : 0; 
        
        // Menghitung Tingkat Kelulusan (Misal KKM = 70)
        $lulus = $semuaDinilai->where('score', '>=', 70)->count();
        $tingkatKelulusan = $semuaDinilai->count() > 0 ? round(($lulus / $semuaDinilai->count()) * 100) : 0; 

        $topSiswa = User::where('role', 'student')->latest()->take(5)->get();

        // 2. Kalkulasi Distribusi Nilai (Ganti kolom 'nilai' menjadi 'score')
        $distribusi = [
            '90-100' => $semuaDinilai->whereBetween('score', [90, 100])->count(),
            '80-89'  => $semuaDinilai->whereBetween('score', [80, 89])->count(),
            '70-79'  => $semuaDinilai->whereBetween('score', [70, 79])->count(),
            '60-69'  => $semuaDinilai->whereBetween('score', [60, 69])->count(),
            '<60'    => $semuaDinilai->where('score', '<', 60)->count(),
        ];

        $persenDistribusi = [];
        foreach ($distribusi as $key => $jml) {
            $persenDistribusi[$key] = round(($jml / $totalDinilai) * 100);
        }

        // 3. Kalkulasi Kelas
        $kemajuanKelas = User::where('role', 'student')
            ->whereNotNull('kelas')
            ->selectRaw('kelas, COUNT(id) as total_siswa')
            ->groupBy('kelas')
            ->get();

        return view('teacher.reports.index', compact(
            'totalSiswa',
            'modulSelesai',
            'rataRataNilai',
            'tingkatKelulusan',
            'topSiswa',
            'distribusi',
            'persenDistribusi',
            'kemajuanKelas'
        ));
    }
}