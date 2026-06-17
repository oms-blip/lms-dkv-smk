<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Course;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function store(Request $request, $course_id)
    {
        // Validasi agar judul tidak kosong
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        // Simpan data
        Module::create([
            'course_id' => $course_id,
            'title' => $request->title,
        ]);

        return redirect()->back()->with('success', 'Modul baru berhasil ditambahkan!');
    }
}