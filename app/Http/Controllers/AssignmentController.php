<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Assignment;
use App\Models\Submission;
use App\Models\User;

class AssignmentController extends Controller
{
   public function index()
{
    $user = Auth::user();
    $courseIds = Course::where('teacher_id', $user->id)->pluck('id');

    // 1. Hitung Total Tugas Buatan
    $totalTugas = Assignment::whereIn('course_id', $courseIds)->count();

    // 2. Hitung Statistik Pengumpulan
    $menungguDinilai = Submission::whereHas('assignment', function($q) use ($courseIds) {
        $q->whereIn('course_id', $courseIds);
    })->where('status', 'Menunggu')->count();

    $selesaiDinilai = Submission::whereHas('assignment', function($q) use ($courseIds) {
        $q->whereIn('course_id', $courseIds);
    })->where('status', 'Sudah Dinilai')->count();

    // 3. Ambil List Tugas beserta jumlah submisi
    $assignments = Assignment::whereIn('course_id', $courseIds)
        ->with('course')
        ->withCount('submissions') 
        ->withCount(['submissions as graded_count' => function ($query) {
            $query->where('status', 'Sudah Dinilai'); 
        }])
        ->latest()
        ->get();

    return view('teacher.tasks.index', compact(
        'assignments', 
        'totalTugas', 
        'menungguDinilai', 
        'selesaiDinilai'
    ));
}

    // 👇 SEKARANG FUNGSI CREATE SUDAH BERDIRI DI SINI DENGAN AMAN BOS 👇
    public function create()
    {
        // Mengambil materi/kelas buatan guru ini untuk pilihan dropdown tugas
        $user = Auth::user();
        $courses = Course::where('teacher_id', $user->id)->get(); 

        // Mengarahkan ke halaman formulir tambah tugas baru
       return view('teacher/tasks/create', compact('courses'));     
    }
public function store(Request $request)
    {
        // 1. Validasi Inputan (Perhatikan course_name menggantikan course_id)
        $request->validate([
           'course_id'   => 'required|exists:courses,id',
            'title'       => 'required|string|max:255',
            'description' => 'required',
            'deadline'    => 'required|date',
           'file_path'   => 'nullable|string',
            'link_url'    => 'nullable|url',
        ]);

        // 2. TRIK SAKTI: Cari materi berdasarkan nama. Kalau nggak ada, otomatis bikin baru!
        // Catatan: Ganti 'title' menjadi nama kolom judul di tabel courses lu (misal 'name' atau 'judul')
        $course = \App\Models\Course::firstOrCreate(
            ['title' => $request->course_name, 'teacher_id' => Auth::id()]
        );

        // 3. Siapkan data tugas yang akan disimpan
        $assignment = new \App\Models\Assignment();
        $assignment->course_id = $course->id; // Ambil ID dari materi yang diketik tadi
        $assignment->title = $request->title;
        $assignment->description = $request->description;
        $assignment->deadline = $request->deadline;
        $assignment->link_url = $request->link_url;

        // 4. Proses Upload File PDF (Jika ada)
        if ($request->hasFile('file_path')) {
            $assignment->file_path   = $request->file_path;;
        }

        // 5. Simpan ke database
        $assignment->save();

        // 6. Kembali ke halaman kelola tugas
        return redirect()->route('teacher.tasks.index')->with('success', 'Tugas berhasil diterbitkan!');
    }
    /**
     * Menampilkan Halaman Detail Tugas
     */
    public function show($id)
    {
        // Cari tugas berdasarkan ID
        $assignment = \App\Models\Assignment::findOrFail($id);
        
        // Arahkan ke halaman view detail tugas
        return view('teacher.tasks.show', compact('assignment'));
    }

    /**
     * Menampilkan Halaman Penilaian Tugas
     */
    /**
     * Menampilkan Halaman Tabel Penilaian (Daftar Siswa yang Kumpul)
     */
    public function grade($id)
    {
        // Ambil tugas beserta seluruh data pengumpulan (submissions) & data siswanya
        $assignment = \App\Models\Assignment::with(['course', 'submissions.student'])->findOrFail($id);
        
        return view('teacher.tasks.grade', compact('assignment'));
    }
    /**
     * Menampilkan Halaman Edit Tugas
     */
    public function edit($id)
    {
        $assignment = \App\Models\Assignment::findOrFail($id);
        
        // Kita butuh data courses juga untuk dropdown pilihan materi saat ngedit
        $courses = \App\Models\Course::all(); 
        
        return view('teacher.tasks.edit', compact('assignment', 'courses'));
    }
    /**
     * Memproses Penyimpanan Data Setelah Edit
     */
    /**
     * Memproses Penyimpanan Data Setelah Edit
     */
    public function update(Request $request, $id)
    {
        // 1. Validasi Inputan
        $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'deadline' => 'required|date',
            'description' => 'required',
            'file_path' => 'nullable|file|mimes:pdf|max:5120', 
        ]);

        // 2. Cari Data Tugas
        $assignment = \App\Models\Assignment::findOrFail($id);

        // 3. Update Data Text
        $assignment->title = $request->title;
        $assignment->course_id = $request->course_id;
        $assignment->deadline = $request->deadline;
        $assignment->description = $request->description;
        $assignment->link_url = $request->link_url;

        // 4. Proses Upload File Baru (Jika ada)
       if ($request->filled('file_path')) {
            $assignment->file_path = $request->file_path;;
        }

        // 5. Simpan ke Database
        $assignment->save();

        // 6. Redirect Balik
        return redirect()->route('teacher.tasks.show', $id)
                         ->with('success', 'Tugas berhasil diperbarui!');
    }
  /**
     * Menampilkan Form Penilaian untuk 1 Siswa Spesifik
     */
    public function gradeStudent($assignment_id, $submission_id)
    {
        $assignment = \App\Models\Assignment::findOrFail($assignment_id);
        
        // Ambil data pengumpulan asli berdasarkan ID submission
        $submission = \App\Models\Submission::with('student')->findOrFail($submission_id);

        return view('teacher.tasks.grade-student', compact('assignment', 'submission'));
    }
    /**
  * Memproses Penyimpanan Nilai Siswa
  */
 public function saveGrade(Request $request, $id)
 {
     $request->validate([
         'score' => 'required|numeric|min:0|max:100',
         'feedback' => 'nullable|string'
     ]);

     $submission = \App\Models\Submission::findOrFail($id);
     $submission->score = $request->score;
     $submission->feedback = $request->feedback;
     $submission->status = 'Sudah Dinilai'; // Otomatis ubah status
     $submission->save();

     // Redirect kembali ke tabel daftar pengumpulan
     return redirect()->route('teacher.tasks.grade', $submission->assignment_id)
                      ->with('success', 'Nilai karya siswa berhasil disimpan!');
 }
 /**
     * Menghapus Tugas beserta file lampirannya
     */
    public function destroy($id)
    {
        $assignment = \App\Models\Assignment::findOrFail($id);

        // 1. Hapus file PDF dari penyimpanan (storage) agar tidak jadi sampah server
        if ($assignment->file_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($assignment->file_path)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($assignment->file_path);
        }

        // 2. Hapus data tugas dari database
        $assignment->delete();

        // 3. Kembalikan ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('teacher.tasks.index')->with('success', 'Tugas berhasil dihapus permanen!');
    }

} 