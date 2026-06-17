<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Assignment;
use App\Models\Submission;

class AssignmentController extends Controller
{
    public function index()
{
    $user = Auth::user();
    $courseIds = Course::where('teacher_id', $user->id)->pluck('id');

    // 1. Ambil semua tugas guru tersebut
    $assignments = Assignment::whereIn('course_id', $courseIds)
        ->with('course')
        ->withCount('submissions')
        ->latest()
        ->get();

    // 2. Hitung statistik
    $totalTugas = $assignments->count();
    
    // Hitung berdasarkan status 'Menunggu' (sesuai default di migrasi kamu)
    $menungguDinilai = Submission::whereIn('assignment_id', $assignments->pluck('id'))
        ->where('status', 'Menunggu') 
        ->count();

    // Hitung yang sudah dinilai (misal statusnya 'Dinilai' atau 'Selesai')
    // Ganti 'Dinilai' dengan string yang kamu pakai di aplikasi untuk tugas yang sudah selesai
    $selesaiDinilai = Submission::whereIn('assignment_id', $assignments->pluck('id'))
        ->where('status', 'Dinilai') 
        ->count();

    return view('teacher.tasks.index', compact('assignments', 'totalTugas', 'menungguDinilai', 'selesaiDinilai'));
}

    public function create()
    {
        $courses = Course::where('teacher_id', Auth::id())->get(); 
        return view('teacher.tasks.create', compact('courses'));    
    }

    public function store(Request $request)
    {
        // 1. Validasi: Sekarang pakai course_id (dropdown)
        $request->validate([
            'course_id'   => 'required|exists:courses,id',
            'title'       => 'required|string|max:255',
            'description' => 'required',
            'deadline'    => 'required|date',
            'file_path'   => 'nullable|string', // Terima link teks
            'link_url'    => 'nullable|url',
        ]);

        // 2. Simpan data tugas (Langsung pakai ID, gak perlu bikin kursus baru lagi!)
        $assignment = new Assignment();
        $assignment->course_id   = $request->course_id;
        $assignment->title       = $request->title;
        $assignment->description = $request->description;
        $assignment->deadline    = $request->deadline;
        $assignment->file_path   = $request->file_path; // Simpan Link
        $assignment->link_url    = $request->link_url;

        $assignment->save();

        return redirect()->route('teacher.tasks.index')->with('success', 'Tugas berhasil diterbitkan!');
    }

    public function update(Request $request, $id)
    {
        // Validasi diperbarui (file_path sekarang string)
        $request->validate([
            'title'       => 'required|string|max:255',
            'course_id'   => 'required|exists:courses,id',
            'deadline'    => 'required|date',
            'description' => 'required',
            'file_path'   => 'nullable|string', 
        ]);

        $assignment = Assignment::findOrFail($id);
        
        $assignment->title       = $request->title;
        $assignment->course_id   = $request->course_id;
        $assignment->deadline    = $request->deadline;
        $assignment->description = $request->description;
        $assignment->link_url    = $request->link_url;
        $assignment->file_path   = $request->file_path;

        $assignment->save();

        return redirect()->route('teacher.tasks.show', $id)->with('success', 'Tugas berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Assignment::findOrFail($id)->delete();
        return redirect()->route('teacher.tasks.index')->with('success', 'Tugas berhasil dihapus!');
    }

    public function show($id) {
        $assignment = Assignment::findOrFail($id);
        return view('teacher.tasks.show', compact('assignment'));
    }

    public function grade($id) {
        $assignment = Assignment::with(['course', 'submissions.student'])->findOrFail($id);
        return view('teacher.tasks.grade', compact('assignment'));
    }

    public function edit($id) {
        $assignment = Assignment::findOrFail($id);
        $courses = Course::where('teacher_id', Auth::id())->get();
        return view('teacher.tasks.edit', compact('assignment', 'courses'));
    }
}