<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Submission;

class UserController extends Controller
{
   public function studentsIndex()
    {
        // 1. Ambil data siswa berserta tugas yang sudah dinilai
        $students = \App\Models\User::where('role', 'student')
            ->with(['submissions' => function($query) {
                $query->where('status', 'Sudah Dinilai');
            }])->get();

        $totalAssignments = \App\Models\Assignment::count();
        $totalSiswa = $students->count();
        $totalNilaiKelas = 0;
        $perluPerhatian = 0;

        // 2. Lakukan perhitungan untuk setiap siswa
        foreach ($students as $student) {
            // Hitung rata-rata nilai siswa
            $student->rata_rata = $student->submissions->avg('score') ? round($student->submissions->avg('score')) : 0;
            
            // Hitung tugas yang diselesaikan
            $student->tugas_selesai = $student->submissions->count();
            $student->total_tugas = $totalAssignments;
            
            // Hitung persentase progress
            $student->progress = $totalAssignments > 0 ? round(($student->tugas_selesai / $totalAssignments) * 100) : 0;

            // Flag "Perlu Perhatian" (jika nilai rata-rata di bawah 70 atau belum kumpul tugas sama sekali)
            if (($totalAssignments > 0 && $student->tugas_selesai == 0) || ($student->tugas_selesai > 0 && $student->rata_rata < 70)) {
                $perluPerhatian++;
            }

            $totalNilaiKelas += $student->rata_rata;
        }

        // 3. Statistik Global Kelas
        $rataRataKelas = $totalSiswa > 0 ? round($totalNilaiKelas / $totalSiswa) : 0;
        $siswaAktif = $totalSiswa; // Sementara disamakan dengan total siswa

        return view('teacher.students.index', compact(
            'students', 'totalSiswa', 'rataRataKelas', 'siswaAktif', 'perluPerhatian'
        ));
    }
}