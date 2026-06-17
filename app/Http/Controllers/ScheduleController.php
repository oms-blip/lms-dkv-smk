<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    // 1. Menampilkan Halaman Kelola Jadwal
    public function index()
    {
        // Ambil jadwal milik guru yang login, urutkan dari Senin-Minggu, lalu berdasarkan jam
        $schedules = Schedule::where('teacher_id', Auth::id())
            ->orderByRaw("FIELD(day, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
            ->orderBy('start_time')
            ->get()
            ->groupBy('day'); // Kelompokkan berdasarkan hari

        return view('teacher.schedules.index', compact('schedules'));
    }

    // 2. Menyimpan Jadwal Baru ke Database
  // 2. Menyimpan Jadwal Baru ke Database
    public function store(Request $request)
    {
        // Validasi isian formulir
        $request->validate([
            'day' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'nullable',
            'title' => 'required|string|max:255',
            'room' => 'required|string|max:255',
        ]);

        // Simpan data pakai jalur Object (Bypass Mass Assignment)
        $schedule = new Schedule();
        $schedule->teacher_id = Auth::id(); // Mengambil ID guru yang sedang login
        $schedule->day = $request->day;
        $schedule->start_time = $request->start_time;
        $schedule->end_time = $request->end_time;
        $schedule->title = $request->title;
        $schedule->room = $request->room;
        
        $schedule->save(); // Simpan permanen ke database

        // Langsung arahkan balik ke dashboard setelah sukses
        return redirect('/dashboard')->with('success', 'Jadwal kelas berhasil ditambahkan!');
    }
    // 3. Menghapus Jadwal
    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        
        // Pastikan hanya guru pembuat jadwal yang bisa menghapus
        if ($schedule->teacher_id == Auth::id()) {
            $schedule->delete();
        }

        return redirect()->back()->with('success', 'Jadwal berhasil dihapus!');
    }
}