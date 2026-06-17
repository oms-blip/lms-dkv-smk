<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div>
                <h2 class="text-[26px] font-extrabold text-slate-800 leading-tight tracking-tight">Laporan & Nilai</h2>
                <p class="text-sm text-slate-500 flex items-center mt-1 font-medium">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                </p>
            </div>
            
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-3 border-l border-slate-200 pl-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold text-slate-800">{{ auth()->user()->name ?? 'Guru DKV' }}</p>
                        <p class="text-[11px] text-slate-400 font-medium">Panel Guru</p>
                    </div>
                    <img class="w-10 h-10 rounded-full object-cover ring-2 ring-slate-100" src="{{ auth()->user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name ?? 'Guru').'&background=f1f5f9' }}" alt="Profile">
                </div>
            </div>
        </div>
    </x-slot>

    <div class="p-8 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto space-y-6">

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-2">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-blue-500 shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <div>
                        <h1 class="text-[24px] font-bold text-slate-800 tracking-tight">Laporan & Nilai</h1>
                        <p class="text-slate-500 text-[13px] mt-0.5">Ringkasan performa pembelajaran dan analisis nilai.</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <select class="bg-white border border-slate-200 text-slate-700 text-sm font-semibold rounded-xl py-2.5 px-4 focus:ring-blue-500 shadow-sm cursor-pointer outline-none">
                        <option>Semua Waktu (All Time)</option>
                    </select>
                    <button onclick="alert('Mengekspor file PDF Laporan & Nilai...')" class="bg-[#1e293b] text-white px-5 py-2.5 rounded-xl font-bold text-sm hover:bg-slate-900 shadow-md shadow-slate-900/20 flex items-center transition-all">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Export PDF
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-[24px] border border-slate-100 shadow-sm flex flex-col justify-between hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-[14px] bg-blue-50 text-blue-500 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-3xl font-extrabold text-slate-800">{{ $totalSiswa ?? 0 }}</h3>
                        <p class="text-[11px] text-slate-400 font-medium mt-1 uppercase tracking-wider">Jumlah Siswa</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-[24px] border border-slate-100 shadow-sm flex flex-col justify-between hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-[14px] bg-emerald-50 text-emerald-500 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-3xl font-extrabold text-slate-800">{{ $modulSelesai ?? 0 }}</h3>
                        <p class="text-[11px] text-slate-400 font-medium mt-1 uppercase tracking-wider">Modul Terbuat</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-[24px] border border-slate-100 shadow-sm flex flex-col justify-between hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-[14px] bg-purple-50 text-purple-500 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-3xl font-extrabold text-slate-800">{{ $rataRataNilai ?? 0 }}</h3>
                        <p class="text-[11px] text-slate-400 font-medium mt-1 uppercase tracking-wider">Rata-rata Nilai Kelas</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-[24px] border border-slate-100 shadow-sm flex flex-col justify-between hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-[14px] bg-amber-50 text-amber-500 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-3xl font-extrabold text-slate-800">{{ $tingkatKelulusan ?? 0 }}%</h3>
                        <p class="text-[11px] text-slate-400 font-medium mt-1 uppercase tracking-wider">Tingkat Kelulusan (KKM 70)</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 pb-10">
                
                <div class="space-y-6">
                    <div class="bg-white rounded-[24px] border border-slate-100 p-8 shadow-sm">
                        <h3 class="text-lg font-bold text-slate-800 mb-1">Distribusi Nilai Keseluruhan</h3>
                        <p class="text-xs text-slate-400 mb-6">Dari seluruh tugas yang sudah dinilai</p>

                        <div class="space-y-5">
                            <div class="flex items-center">
                                <span class="w-14 text-sm font-bold text-slate-700">90-100</span>
                                <div class="flex-1 h-8 bg-slate-50 rounded-full mx-3 overflow-hidden flex"><div class="h-8 bg-[#10b981] flex items-center px-4 justify-start text-white text-xs font-bold transition-all duration-1000" style="width: {{ $persenDistribusi['90-100'] ?? 0 }}%;">{{ $distribusi['90-100'] ?? 0 }}</div></div>
                                <span class="w-8 text-right text-sm text-slate-400 font-medium">{{ $persenDistribusi['90-100'] ?? 0 }}%</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-14 text-sm font-bold text-slate-700">80-89</span>
                                <div class="flex-1 h-8 bg-slate-50 rounded-full mx-3 overflow-hidden flex"><div class="h-8 bg-[#3b82f6] flex items-center px-4 justify-start text-white text-xs font-bold transition-all duration-1000" style="width: {{ $persenDistribusi['80-89'] ?? 0 }}%;">{{ $distribusi['80-89'] ?? 0 }}</div></div>
                                <span class="w-8 text-right text-sm text-slate-400 font-medium">{{ $persenDistribusi['80-89'] ?? 0 }}%</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-14 text-sm font-bold text-slate-700">70-79</span>
                                <div class="flex-1 h-8 bg-slate-50 rounded-full mx-3 overflow-hidden flex"><div class="h-8 bg-[#f59e0b] flex items-center px-4 justify-start text-white text-xs font-bold transition-all duration-1000" style="width: {{ $persenDistribusi['70-79'] ?? 0 }}%;">{{ $distribusi['70-79'] ?? 0 }}</div></div>
                                <span class="w-8 text-right text-sm text-slate-400 font-medium">{{ $persenDistribusi['70-79'] ?? 0 }}%</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-14 text-sm font-bold text-slate-700">60-69</span>
                                <div class="flex-1 h-8 bg-slate-50 rounded-full mx-3 overflow-hidden flex"><div class="h-8 bg-[#8b5cf6] flex items-center px-4 justify-start text-white text-[10px] font-bold transition-all duration-1000" style="width: {{ $persenDistribusi['60-69'] ?? 0 }}%;">{{ $distribusi['60-69'] ?? 0 }}</div></div>
                                <span class="w-8 text-right text-sm text-slate-400 font-medium">{{ $persenDistribusi['60-69'] ?? 0 }}%</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-14 text-sm font-bold text-slate-700">&lt;60</span>
                                <div class="flex-1 h-8 bg-slate-50 rounded-full mx-3 overflow-hidden flex"><div class="h-8 bg-[#ef4444] flex items-center px-3 justify-start text-white text-[10px] font-bold transition-all duration-1000" style="width: {{ $persenDistribusi['<60'] ?? 0 }}%;">{{ $distribusi['<60'] ?? 0 }}</div></div>
                                <span class="w-8 text-right text-sm text-slate-400 font-medium">{{ $persenDistribusi['<60'] ?? 0 }}%</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-[24px] border border-slate-100 p-8 shadow-sm">
                        <h3 class="text-lg font-bold text-slate-800 mb-1">Daftar Kelas</h3>
                        <p class="text-xs text-slate-400 mb-6">Jumlah persebaran siswa per kelas</p>

                        <div class="space-y-6">
                            @forelse($kemajuanKelas ?? [] as $kelas)
                                <div>
                                    <div class="flex justify-between items-center mb-2">
                                        <div class="flex items-center gap-3">
                                            <span class="font-bold text-sm text-slate-800">{{ $kelas->kelas }}</span>
                                            <span class="px-2 py-0.5 bg-slate-100 text-slate-500 text-[10px] font-medium rounded-md">{{ $kelas->total_siswa }} siswa</span>
                                        </div>
                                    </div>
                                    <div class="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden">
                                        <div class="bg-blue-600 h-full rounded-full transition-all duration-500" style="width: 100%"></div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-6">
                                    <p class="text-xs text-slate-400 font-bold">Data kelas belum tersedia.</p>
                                    <p class="text-[10px] text-slate-400 mt-1">Kolom 'kelas' di tabel user mungkin belum diisi.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-[24px] border border-slate-100 p-8 shadow-sm h-fit">
                    <h3 class="text-lg font-bold text-slate-800 mb-1">Laporan Tersedia</h3>
                    <p class="text-xs text-slate-400 mb-5">Download laporan dalam format PDF</p>

                    <div class="space-y-3">
                        <a href="javascript:void(0)" onclick="alert('Sedang mengunduh file: Rekap_Nilai_Semester_1.pdf 📥')" class="flex items-center justify-between p-4 rounded-xl border border-slate-100 hover:border-slate-200 hover:bg-slate-50 transition-all group">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-800 text-sm">Rekap Nilai Keseluruhan</p>
                                    <p class="text-[11px] text-slate-400">Seluruh tugas siswa</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        </a>

                        <a href="javascript:void(0)" onclick="alert('Sedang menyusun laporan: Progress_Materi_DKV.pdf ⏳')" class="flex items-center justify-between p-4 rounded-xl border border-slate-100 hover:border-slate-200 hover:bg-slate-50 transition-all group">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-800 text-sm">Laporan Progress Materi</p>
                                    <p class="text-[11px] text-slate-400">Tingkat penyelesaian per modul</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>