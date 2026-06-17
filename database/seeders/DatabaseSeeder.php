<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Akun Guru
        User::create([
            'name' => 'Guru DKV',
            'email' => 'guru@lms.com',
            'password' => Hash::make('password123'),
            'role' => 'teacher',
        ]);

        // 2. Buat Akun Siswa
        User::create([
            'name' => 'Siswa DKV',
            'email' => 'siswa@lms.com',
            'password' => Hash::make('password123'),
            'role' => 'student',
        ]);
    }
}