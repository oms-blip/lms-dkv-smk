<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleAuthController extends Controller
{
    // Mengarahkan user ke halaman login Google
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    // Menerima data balikan dari Google
   public function callback()
{
    try {
        $googleUser = Socialite::driver('google')->user();

        // 1. Cek apakah email ini sudah ada di database
        $user = User::where('email', $googleUser->getEmail())->first();

        // 2. Kalau belum ada, OTOMATIS jadikan dia SISWA (Demi Keamanan)
        if (!$user) {
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'password' => bcrypt('password_dummy_123'), // Siswa login via google gak butuh password ini
                'role' => 'student', // <-- Paksa jadi siswa kalau mau daftar sendiri
            ]);
        }

        // 3. Masukkan / Loginkan user tersebut ke sistem
        Auth::login($user);

        // 4. ALUR PENGALIHAN (REDIRECT) BERDASARKAN ROLE
        if ($user->role === 'teacher' || $user->role === 'admin') {
            // Kalau dia Guru/Admin, lempar ke Dashboard Guru
            return redirect()->route('dashboard'); 
        }

        // Kalau dia Siswa, lempar ke Katalog/Halaman Siswa
        return redirect()->route('student.katalog'); 

    } catch (\Exception $e) {
        // Kalau error (misal nutup tab pas milih email), balik ke halaman login awal
        return redirect('/login')->with('error', 'Login Google dibatalkan atau gagal.');
    }
}
}