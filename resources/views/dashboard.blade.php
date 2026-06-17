<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div>
                <h2 class="text-[26px] font-extrabold text-slate-800 leading-tight tracking-tight">Dashboard</h2>
                <p class="text-sm text-slate-500 flex items-center mt-1 font-medium">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                </p>
            </div>
            
            <div class="flex items-center space-x-6">
                <div class="relative w-[300px] hidden md:block">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" class="block w-full py-2.5 pl-11 pr-4 text-sm text-slate-900 border border-slate-200 rounded-full bg-slate-50 focus:ring-blue-500 focus:border-blue-500 shadow-sm" placeholder="Cari siswa, materi, tugas...">
                </div>

                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-3 border-l border-slate-200 pl-4">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-bold text-slate-800">{{ auth()->user()->name ?? 'Guru DKV' }}</p>
                            <p class="text-[11px] text-slate-400 font-medium">Panel Guru</p>
                        </div>
                        <img class="w-10 h-10 rounded-full object-cover ring-2 ring-slate-100" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Guru DKV') }}&background=f1f5f9" alt="Profile">
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="p-8 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto space-y-6">

            <div class="bg-[#1e293b] rounded-[24px] p-8 flex flex-col md:flex-row items-start md:items-center justify-between shadow-lg relative overflow-hidden gap-6">
                <div class="absolute right-0 top-0 w-64 h-full bg-gradient-to-l from-blue-600/20 to-transparent"></div>
                <div class="flex items-center gap-6 relative z-10">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Guru DKV') }}&background=cbd5e1" class="w-20 h-20 rounded-full border-4 border-slate-700 shadow-md shrink-0">
                    <div>
                        <p class="text-blue-400 text-xs font-bold tracking-[0.2em] uppercase flex items-center mb-1">
                            <svg class="w-4 h-4 mr-1 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            Selamat Datang
                        </p>
                        <h2 class="text-3xl font-bold text-white mb-2">{{ auth()->user()->name ?? 'Guru Hebat' }}</h2>
                        <p class="text-slate-300 text-sm">Ada <span class="font-bold text-white">{{ $perluDinilai ?? 0 }} tugas</span> yang menunggu penilaian dan <span class="font-bold text-white">{{ $totalSiswa ?? 0 }} siswa</span> aktif belajar hari ini.</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-[24px] border border-slate-100 shadow-sm flex flex-col justify-between hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start mb-4">
                        <div class="text-[40px] font-bold text-slate-800 leading-none">{{ $totalSiswa ?? 0 }}</div>
                        <span class="flex items-center text-xs font-bold text-emerald-500 bg-emerald-50 px-2 py-1 rounded-md"><svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg> Aktif</span>
                    </div>
                    <p class="text-xs text-slate-500 font-medium">Total Siswa Terdaftar</p>
                </div>
                <div class="bg-white p-6 rounded-[24px] border border-slate-100 shadow-sm flex flex-col justify-between hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start mb-4">
                        <div class="text-[40px] font-bold text-emerald-500 leading-none">{{ $materiAktif ?? 0 }}</div>
                        <span class="flex items-center text-xs font-bold text-emerald-500 bg-emerald-50 px-2 py-1 rounded-md"><svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg> +1</span>
                    </div>
                    <p class="text-xs text-slate-500 font-medium">Materi Aktif & Dipublish</p>
                </div>
                <div class="bg-white p-6 rounded-[24px] border border-slate-100 shadow-sm flex flex-col justify-between hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start mb-4">
                        <div class="text-[40px] font-bold text-amber-500 leading-none">{{ $perluDinilai ?? 0 }}</div>
                        <span class="flex items-center text-xs font-bold text-amber-600 bg-amber-50 px-2 py-1 rounded-md"><svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg> Cek</span>
                    </div>
                    <p class="text-xs text-slate-500 font-medium">Perlu Dinilai • Tugas menunggu</p>
                </div>
                <div class="bg-white p-6 rounded-[24px] border border-slate-100 shadow-sm flex flex-col justify-between hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start mb-4">
                        <div class="text-[40px] font-bold text-purple-600 leading-none">{{ isset($rataRataNilai) ? round($rataRataNilai) : 0 }}%</div>
                        <span class="flex items-center text-xs font-bold text-emerald-500 bg-emerald-50 px-2 py-1 rounded-md"><svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg> +8%</span>
                    </div>
                    <p class="text-xs text-slate-500 font-medium">Rata-rata Nilai Siswa</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 pb-10">
                
                <div class="lg:col-span-8 space-y-6">
                    
                    <div class="bg-white p-6 rounded-[24px] border border-slate-100 shadow-sm overflow-hidden">
                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <h3 class="font-bold text-lg text-slate-800 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    Monitoring Pengumpulan
                                </h3>
                                <p class="text-xs text-slate-400 ml-7">Performa terbaru siswa</p>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left whitespace-nowrap">
                                <thead class="text-[11px] uppercase text-slate-400 font-bold border-b border-slate-100">
                                    <tr>
                                        <th class="pb-3 px-2">Siswa</th>
                                        <th class="pb-3 px-2">Tugas</th>
                                        <th class="pb-3 text-center px-2">Status</th>
                                        <th class="pb-3 text-right px-2">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50">
                                    @forelse($monitoringSiswa ?? [] as $sub)
                                        <tr class="hover:bg-slate-50/50 transition-colors">
                                            <td class="py-3 px-2 flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-xs">
                                                    {{ strtoupper(substr($sub->user->name ?? 'S', 0, 1)) }}
                                                </div>
                                                <div><p class="font-bold text-sm text-slate-800">{{ $sub->user->name ?? 'Siswa' }}</p></div>
                                            </td>
                                            <td class="py-3 px-2 text-sm text-slate-600">{{ $sub->assignment->title ?? 'Tugas' }}</td>
                                            <td class="py-3 px-2 text-center">
                                                <span class="px-2 py-1 {{ $sub->status == 'Sudah Dinilai' ? 'bg-emerald-50 text-emerald-600' : 'bg-amber-50 text-amber-600' }} text-[10px] font-bold rounded-md">
                                                    {{ $sub->status }}
                                                </span>
                                            </td>
                                            <td class="py-3 px-2 text-right font-black {{ $sub->score >= 80 ? 'text-emerald-500' : 'text-slate-800' }}">
                                                {{ $sub->score !== null ? $sub->score : '-' }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="py-8 text-center text-slate-400 text-xs">Belum ada tugas yang dikumpulkan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-4 space-y-6">
                    <div class="bg-white p-6 rounded-[24px] border border-slate-100 shadow-sm">
                        <h3 class="font-bold text-lg text-slate-800 mb-5 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Jadwal Hari Ini
                        </h3>
                        <div class="relative border-l-2 border-slate-100 ml-2 space-y-6">
                            <div class="relative pl-5">
                                <div class="absolute w-3 h-3 bg-white border-2 border-blue-500 rounded-full -left-[7px] top-1"></div>
                                <div class="text-xs font-bold text-slate-800 mb-0.5 flex justify-between">
                                    <span>Sekarang</span> <span class="text-slate-600 truncate ml-2">Review Tugas</span>
                                </div>
                                <div class="text-[10px] text-slate-400 text-right">Online</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>