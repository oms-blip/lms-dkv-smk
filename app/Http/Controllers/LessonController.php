<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function store(Request $request, Module $module)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'video_url' => 'nullable|url',
        ]);

       $module->lessons()->create([
    'title' => $request->title,
    'content' => $request->input('content'), 
    'video_url' => $request->video_url,
    'order' => $module->lessons()->count() + 1,
]);

        return back()->with('success', 'Materi berhasil ditambahkan!');
    }

    public function update(Request $request, Lesson $lesson)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'video_url' => 'nullable|url',
        ]);

        $lesson->update($request->all());

        return back()->with('success', 'Materi berhasil diperbarui!');
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return back()->with('success', 'Materi berhasil dihapus!');
    }
}