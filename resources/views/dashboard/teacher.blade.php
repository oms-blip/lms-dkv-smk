<x-app-layout>
    <!-- ========================================== -->
    <!-- HEADER / TOPBAR GURU                       -->
    <!-- ========================================== -->
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <!-- Judul & Tanggal -->
            <div>
                <h2 class="text-xl font-extrabold text-slate-800 leading-tight">Dashboard</h2>
                <p class="text-xs text-slate-500 font-medium mt-1 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    {{ now()->format('l, d F Y') }}
                </p>
            </div>

            <!-- Pencarian & Profil Guru -->
            <div class="flex items-center gap-6">
                <div class="relative hidden md:block w-72">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" class="bg-slate-100 border-none text-slate-600 text-sm rounded-full focus:ring-2 focus:ring-slate-800 block w-full pl-10 py-2 transition-all" placeholder="Cari siswa, materi, tugas...">
                </div>

                <div class="flex items-center space-x-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-extrabold text-slate-800 leading-tight capitalize">{{ $user->name }}</p>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">Guru DKV</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-slate-800 text-white flex items-center justify-center font-bold shadow-md uppercase">
                        {{ substr($user->name, 0, 2) }}
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <!-- ========================================== -->
    <!-- KONTEN UTAMA DASHBOARD GURU                -->
    <!-- ========================================== -->
    <div class="p-6 sm:p-8 bg-[#f8fafc] min-h-screen">
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            
            <!-- KOLOM KIRI & TENGAH (Lebar 2 Kolom) -->
            <div class="xl:col-span-2 space-y-8">
                
                <!-- 1. Banner Gelap Khas Guru -->
                <div class="bg-[#0f172a] rounded-[24px] p-8 text-white shadow-xl flex items-center gap-6 relative overflow-hidden">
                    <!-- Ornamen Background -->
                    <div class="absolute top-0 right-0 w-64 h-64 bg-blue-500 opacity-10 rounded-full blur-3xl -mr-20 -mt-20"></div>
                    
                    <div class="w-20 h-20 rounded-full bg-slate-800 border-4 border-slate-700 flex items-center justify-center text-3xl font-black shadow-inner uppercase shrink-0 z-10">
                        {{ substr($user->name, 0, 2) }}
                    </div>
                    <div class="relative z-10">
                        <span class="text-[10px] font-bold tracking-widest text-yellow-500 uppercase flex items-center gap-1 mb-1">
                            ⭐ Selamat Datang
                        </span>
                        <h2 class="text-3xl font-black capitalize mb-2">{{ $user->name }}</h2>
                        <p class="text-slate-400 text-sm">
                            Ada <span class="font-bold text-white">{{ $pendingTasksCount }} tugas</span> yang menunggu penilaian dan <span class="font-bold text-white">{{ $activeStudentsToday }} siswa</span> aktif belajar hari ini.
                        </p>
                    </div>
                </div>

                <!-- 2. Grid Kartu Statistik -->
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Total Siswa -->
                    <div class="bg-white p-5 rounded-[20px] border border-slate-100 shadow-sm flex flex-col justify-center">
                        <div class="flex items-end justify-between mb-2">
                            <h3 class="text-3xl font-black text-slate-800">{{ $totalStudents }}</h3>
                            <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-md">↑ Aktif</span>
                        </div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Siswa Terdaftar</p>
                    </div>
                    
                    <!-- Materi Aktif -->
                    <div class="bg-white p-5 rounded-[20px] border border-slate-100 shadow-sm flex flex-col justify-center">
                        <div class="flex items-end justify-between mb-2">
                            <h3 class="text-3xl font-black text-emerald-500">{{ $activeCoursesCount }}</h3>
                            <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-md">↑ +1</span>
                        </div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Materi Aktif & Dipublish</p>
                    </div>

                    <!-- Perlu Dinilai -->
                    <div class="bg-white p-5 rounded-[20px] border border-slate-100 shadow-sm flex flex-col justify-center">
                        <div class="flex items-end justify-between mb-2">
                            <h3 class="text-3xl font-black text-orange-500">{{ $pendingTasksCount }}</h3>
                            <span class="text-[10px] font-bold text-orange-600 bg-orange-50 px-2 py-1 rounded-md">⚠️ Cek</span>
                        </div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Perlu Dinilai • Tugas menunggu</p>
                    </div>

                    <!-- Rata-rata Nilai -->
                    <div class="bg-white p-5 rounded-[20px] border border-slate-100 shadow-sm flex flex-col justify-center">
                        <div class="flex items-end justify-between mb-2">
                            <h3 class="text-3xl font-black text-purple-600">{{ $averageStudentScore }}%</h3>
                            <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-md">↑ +8%</span>
                        </div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Rata-rata Nilai Siswa</p>
                    </div>
                </div>

                <!-- 3. Tabel Monitoring Pengumpulan -->
                <div class="bg-white rounded-[24px] border border-slate-100 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-100 flex items-center gap-3">
                        <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-base font-extrabold text-slate-800">Monitoring Pengumpulan</h3>
                            <p class="text-[11px] text-slate-400 font-medium">Performa terbaru siswa</p>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-slate-600">
                            <thead class="bg-slate-50 text-[10px] uppercase font-bold text-slate-400 tracking-wider border-b border-slate-100">
                                <tr>
                                    <th class="px-6 py-4">Siswa</th>
                                    <th class="px-6 py-4">Tugas</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4 text-right">Nilai</th>
                                </tr>
                            </thead>
                          <tbody class="divide-y divide-slate-100">
                                @forelse($recentSubmissions as $submission)
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="px-6 py-4 flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold uppercase">
                                                {{ substr($submission->student->name ?? 'S', 0, 1) }}
                                            </div>
                                            <span class="font-bold text-slate-700 capitalize">{{ $submission->student->name ?? 'Siswa' }}</span>
                                        </td>
                                        <td class="px-6 py-4 text-slate-600 font-medium capitalize">
                                            {{ $submission->assignment->title ?? 'Tugas' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($submission->status == 'Sudah Dinilai')
                                                <span class="px-2.5 py-1 text-[10px] font-bold text-emerald-600 bg-emerald-50 rounded-md">Sudah Dinilai</span>
                                            @else
                                                <span class="px-2.5 py-1 text-[10px] font-bold text-amber-600 bg-amber-50 rounded-md">Menunggu</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-right font-black {{ $submission->score > 0 ? 'text-emerald-500' : 'text-slate-400' }}">
                                            {{ $submission->score ?? '0' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center text-slate-400 text-xs">
                                            Belum ada tugas yang dikumpulkan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <!-- SIDEBAR KANAN (Lebar 1 Kolom) -->
            <div class="xl:col-span-1 space-y-6">
                
                <!-- Jadwal Hari Ini -->
               <div class="bg-white p-6 rounded-[24px] border border-slate-100 shadow-sm">
    
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <h3 class="text-sm font-black text-slate-800 uppercase tracking-wider">Jadwal Hari Ini</h3>
                        </div>
                        
                        <a href="/teacher/schedules" class="p-2 bg-slate-50 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-all border border-transparent hover:border-blue-100" title="Atur Jadwal Kelas">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </a>
                    </div>

                    <div class="relative border-l-2 border-slate-100 ml-2 space-y-5 mt-2">
                        @forelse($todaySchedules as $schedule)
                            <div class="relative pl-5 mb-4 group">
                                <div class="absolute -left-[9px] top-1/2 -translate-y-1/2 w-4 h-4 rounded-full border-[3px] border-white bg-blue-500 shadow-sm group-hover:bg-blue-600 transition-colors"></div>
                                
                                <div class="bg-white p-3.5 rounded-2xl border border-slate-100 flex justify-between items-center hover:border-blue-200 hover:shadow-md transition-all">
                                    <div class="flex flex-col">
                                        <span class="text-xs font-black text-blue-600">{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} WIB</span>
                                        <span class="text-[10px] font-bold text-slate-400 mt-0.5">s/d {{ $schedule->end_time ? \Carbon\Carbon::parse($schedule->end_time)->format('H:i') : 'Selesai' }}</span>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-xs font-extrabold text-slate-800 block capitalize">{{ $schedule->title }}</span>
                                        <span class="text-[10px] text-emerald-500 font-bold block">{{ $schedule->room }}</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="relative pl-5">
                                <div class="absolute -left-[9px] top-1/2 -translate-y-1/2 w-4 h-4 rounded-full border-[3px] border-white bg-slate-200"></div>
                                <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 text-center">
                                    <span class="text-[11px] font-bold text-slate-400 block">Tidak ada jadwal kelas untuk hari ini.</span>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>