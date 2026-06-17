<x-app-layout>
    <!-- ========================================== -->
    <!-- HEADER / TOPBAR                            -->
    <!-- ========================================== -->
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <!-- Kolom Pencarian -->
            <div class="relative w-full md:w-96">
                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" class="bg-slate-100 border-none text-slate-700 text-sm rounded-full focus:ring-2 focus:ring-blue-500 block w-full pl-11 py-2.5 transition-all" placeholder="Cari materi, tugas, atau modul...">
            </div>

            <!-- Profil Siswa Kanan -->
            <div class="hidden md:flex items-center space-x-4">
                <div class="text-right">
                    <p class="text-sm font-extrabold text-slate-800 leading-tight capitalize">{{ $user->name }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">Siswa DKV</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold shadow-md border-2 border-blue-100 uppercase">
                    {{ substr($user->name, 0, 2) }}
                </div>
            </div>
        </div>
    </x-slot>

    <!-- ========================================== -->
    <!-- KONTEN UTAMA DASHBOARD                     -->
    <!-- ========================================== -->
    <div class="p-6 sm:p-8 bg-[#f8fafc] min-h-screen">
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            
            <!-- KOLOM KIRI & TENGAH (Lebar 2 Kolom) -->
            <div class="xl:col-span-2 space-y-8">
                
                <!-- 1. Banner Selamat Datang -->
                <div class="bg-gradient-to-r from-[#2563eb] to-[#1d4ed8] rounded-[24px] p-8 text-white shadow-lg flex flex-col sm:flex-row items-center justify-between relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full blur-3xl -mr-20 -mt-20 pointer-events-none"></div>
                    
                    <div class="relative z-10 space-y-2 text-center sm:text-left">
                        <span class="text-xs font-bold tracking-widest text-blue-200 uppercase flex items-center justify-center sm:justify-start gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                            Selamat Datang Kembali
                        </span>
                        <h2 class="text-3xl font-black capitalize">Halo, {{ explode(' ', trim($user->name))[0] }}! 👋</h2>
                        <p class="text-blue-100 text-sm max-w-md leading-relaxed mt-2">
                            Ayo lanjutkan belajar hari ini. Kamu sudah menyelesaikan <span class="font-bold text-white">{{ $overallProgress }}%</span> dari seluruh materi. Semangat!
                        </p>
                    </div>

                    <div class="relative z-10 mt-6 sm:mt-0 shrink-0">
                        <div class="w-28 h-28 rounded-full border-[6px] border-blue-400/30 flex items-center justify-center relative">
                            <svg class="absolute inset-0 w-full h-full transform -rotate-90">
                                <circle cx="50" cy="50" r="44" stroke="currentColor" stroke-width="6" fill="transparent" class="text-white opacity-20"></circle>
                                <circle cx="50" cy="50" r="44" stroke="currentColor" stroke-width="6" fill="transparent" class="text-white" stroke-dasharray="276" stroke-dashoffset="{{ 276 - (276 * $overallProgress / 100) }}"></circle>
                            </svg>
                            <div class="text-center mt-2">
                                <span class="text-2xl font-black">{{ $overallProgress }}%</span>
                                <p class="text-[9px] uppercase tracking-wider text-blue-200 font-bold">Selesai</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. Grid Kartu Statistik -->
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-white p-5 rounded-[20px] border border-slate-100 shadow-sm flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"></path></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Modul Aktif</p>
                            <h3 class="text-lg font-black text-slate-800">{{ $activeCoursesCount }} <span class="text-xs text-slate-400 font-medium">Kelas</span></h3>
                        </div>
                    </div>
                    <div class="bg-white p-5 rounded-[20px] border border-slate-100 shadow-sm flex items-center space-x-3">
                        <div class="w-10 h-10 bg-emerald-50 text-emerald-500 rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Tugas Selesai</p>
                            <h3 class="text-lg font-black text-slate-800">{{ $completedTasksCount }} <span class="text-xs text-slate-400 font-medium">Tugas</span></h3>
                        </div>
                    </div>
                    <div class="bg-white p-5 rounded-[20px] border border-slate-100 shadow-sm flex items-center space-x-3">
                        <div class="w-10 h-10 bg-purple-50 text-purple-500 rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Jam Belajar</p>
                            <h3 class="text-lg font-black text-slate-800">{{ $learningHours }} <span class="text-xs text-slate-400 font-medium">Jam</span></h3>
                        </div>
                    </div>
                    <div class="bg-white p-5 rounded-[20px] border border-slate-100 shadow-sm flex items-center space-x-3">
                        <div class="w-10 h-10 bg-orange-50 text-orange-500 rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Rata-Rata Nilai</p>
                            <h3 class="text-lg font-black text-slate-800">{{ $averageScore }} <span class="text-xs text-slate-400 font-medium">/ 100</span></h3>
                        </div>
                    </div>
                </div>

                <!-- 3. Daftar Modul dari Database -->
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-base font-extrabold text-slate-800">Modul yang Dipelajari</h3>
                        <a href="{{ route('student.katalog') }}" class="text-xs font-bold text-blue-600 hover:underline flex items-center gap-1">Lihat Semua ➜</a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        @forelse($courses as $course)
                            <div class="bg-white rounded-[24px] border border-slate-100 shadow-sm overflow-hidden flex flex-col justify-between p-5 hover:shadow-md transition-all">
                                <div>
                                    <div class="h-32 bg-gradient-to-br from-blue-50 to-indigo-100 rounded-2xl mb-4 flex items-center justify-center text-blue-500 font-bold text-2xl uppercase shadow-inner">
                                        🎨 {{ substr($course->title, 0, 2) }}
                                    </div>
                                    <h4 class="font-extrabold text-slate-800 text-lg mb-1 capitalize">{{ $course->title }}</h4>
                                    <p class="text-xs text-slate-400 mb-4 flex items-center gap-1">
                                        <span class="w-2 h-2 bg-emerald-500 rounded-full"></span> Aktif Berjalan
                                    </p>
                                    <div class="flex justify-between items-center text-xs font-bold text-slate-600 mb-1.5">
                                        <span>Progress</span>
                                        <span>{{ $course->progress ?? 0 }}%</span> 
                                    </div>
                                    <div class="w-full bg-slate-100 rounded-full h-2 mb-4">
                                        <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $course->progress ?? 0 }}%"></div>
                                    </div>
                                </div>
                                <a href="/classroom/{{ $course->slug ?? 'dasar-dasar' }}" class="w-full py-2.5 bg-slate-50 hover:bg-blue-50 hover:text-blue-600 text-slate-700 text-xs font-bold rounded-xl transition-all flex items-center justify-center gap-1">
                                    Lanjut Belajar ➜
                                </a>
                            </div>
                        @empty
                            <div class="col-span-2 bg-white rounded-2xl p-8 text-center border border-dashed border-slate-300 text-slate-400 text-sm">
                                Belum ada modul pembelajaran yang ditambahkan.
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- 4. Tugas Terbaru -->
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-base font-extrabold text-slate-800">Tugas Terbaru</h3>
                        <a href="#" class="text-xs font-bold text-blue-600 hover:underline">Lihat Semua ➜</a>
                    </div>
                    <div class="space-y-3">
                        @forelse($latestTasks as $task)
                            <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between hover:border-slate-200 transition-all">
                                <div class="space-y-1">
                                    <h4 class="text-sm font-extrabold text-slate-800 capitalize">{{ $task->title }}</h4>
                                    <p class="text-[11px] text-slate-400 flex items-center gap-1">
                                        ⏰ Batas: {{ $task->deadline ?? 'Belum ditentukan' }}
                                    </p>
                                </div>
                                <span class="px-3 py-1.5 rounded-xl text-[10px] font-bold border bg-blue-50 text-blue-600 border-blue-200">
                                    Tugas Aktif
                                </span>
                            </div>
                        @empty
                            <div class="bg-white p-4 rounded-2xl border border-dashed border-slate-300 text-center text-slate-400 text-sm">
                                Yey! Belum ada tugas baru untukmu.
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>

            <!-- SIDEBAR KANAN (Lebar 1 Kolom) -->
            <div class="xl:col-span-1 space-y-6">
                <!-- Progres Keseluruhan -->
                <div class="bg-white p-6 rounded-[24px] border border-slate-100 shadow-sm space-y-4">
                    <h3 class="text-sm font-black text-slate-800 uppercase tracking-wider">Progres Keseluruhan</h3>
                    <div class="space-y-4">
                        @forelse($courses as $course)
                            <div>
                                <div class="flex justify-between text-xs font-bold text-slate-700 mb-1">
                                    <span class="capitalize truncate pr-2">{{ $course->title }}</span>
                                    <span>{{ $course->progress ?? 0 }}%</span>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-1.5">
                                    <div class="bg-blue-600 h-1.5 rounded-full" style="width: {{ $course->progress ?? 0 }}%"></div>
                                </div>
                            </div>
                        @empty
                            <p class="text-xs text-slate-400 text-center py-2">Belum ada progres materi.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Jadwal Hari Ini -->
                <div class="bg-white p-6 rounded-[24px] border border-slate-100 shadow-sm space-y-4">
                    <h3 class="text-sm font-black text-slate-800 uppercase tracking-wider">Jadwal Hari Ini</h3>
                    @forelse($todaySchedules as $schedule)
                        <div class="flex items-start space-x-3 p-3 bg-slate-50/60 rounded-2xl border border-slate-100">
                            <div class="text-center bg-white px-2.5 py-1.5 rounded-xl shadow-sm border border-slate-100">
                                <span class="text-xs font-black text-blue-600 block leading-none">{{ explode('.', $schedule['time'])[0] ?? '00' }}</span>
                                <span class="text-[9px] font-bold text-slate-400 block mt-0.5">{{ explode('.', $schedule['time'])[1] ?? '00' }}</span>
                            </div>
                            <div>
                                <h4 class="text-xs font-extrabold text-slate-800 leading-tight">{{ $schedule['title'] }}</h4>
                                <p class="text-[10px] text-slate-400 mt-0.5">📍 {{ $schedule['room'] }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center p-4">
                            <p class="text-xs text-slate-400">Tidak ada jadwal kelas virtual hari ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>