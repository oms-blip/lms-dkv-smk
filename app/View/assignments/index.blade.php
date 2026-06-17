<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div>
                <h2 class="text-[26px] font-extrabold text-slate-800 leading-tight tracking-tight">Kelola Tugas</h2>
                <p class="text-sm text-slate-500 flex items-center mt-1 font-medium">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                </p>
            </div>
            
            <div class="flex items-center space-x-4">
                <button class="relative text-slate-400 hover:text-blue-600 transition-colors p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                </button>
                <div class="flex items-center space-x-3 border-l border-slate-200 pl-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold text-slate-800">{{ auth()->user()->name ?? 'Guru DKV' }}</p>
                        <p class="text-[11px] text-slate-400 font-medium">Panel Guru</p>
                    </div>
                    <img class="w-10 h-10 rounded-full object-cover ring-2 ring-slate-100" src="{{ auth()->user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=Guru+DKV&background=f1f5f9' }}" alt="Profile">
                </div>
            </div>
        </div>
    </x-slot>

    <div class="p-8 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto space-y-6">

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-2">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-blue-500 shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    </div>
                    <div>
                        <h1 class="text-[24px] font-bold text-slate-800 tracking-tight">Kelola Tugas</h1>
                        <p class="text-slate-500 text-[13px] mt-0.5">Buat tugas baru, lihat pengumpulan, dan berikan penilaian.</p>
                    </div>
                </div>
                <button class="bg-blue-600 text-white px-5 py-2.5 rounded-xl font-bold text-sm hover:bg-blue-700 shadow-md shadow-blue-600/20 flex items-center transition-all">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Buat Tugas Baru
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-[20px] border border-slate-100 shadow-sm flex items-center">
                    <div class="w-14 h-14 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center mr-5 shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-[28px] font-bold text-slate-800 leading-none mb-1">{{ $totalPengumpulan }}</h3>

                        <h3 class="text-[28px] font-bold text-amber-500 leading-none mb-1">{{ $menungguDinilai }}</h3>

                        <h3 class="text-[28px] font-bold text-emerald-500 leading-none mb-1">{{ $selesaiDinilai }}</h3>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-[20px] border border-slate-100 shadow-sm flex items-center">
                    <div class="w-14 h-14 rounded-full bg-amber-50 text-amber-500 flex items-center justify-center mr-5 shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-[28px] font-bold text-amber-500 leading-none mb-1">{{ $menungguDinilai ?? 11 }}</h3>
                        <p class="text-[11px] text-amber-600 font-medium">Menunggu Dinilai</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-[20px] border border-slate-100 shadow-sm flex items-center">
                    <div class="w-14 h-14 rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center mr-5 shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-[28px] font-bold text-emerald-500 leading-none mb-1">{{ $selesaiDinilai ?? 2 }}</h3>
                        <p class="text-[11px] text-emerald-600 font-medium">Tugas Selesai Dinilai</p>
                    </div>
                </div>
            </div>

            <div class="space-y-4 pt-2">
                <div class="relative w-full max-w-3xl">
                    <input type="text" class="w-full pl-12 pr-4 py-3.5 bg-white border border-slate-200 rounded-[16px] focus:ring-blue-500 focus:border-blue-500 shadow-sm text-sm" placeholder="membuat...">
                    <svg class="absolute left-4 top-3.5 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                
                <div class="flex items-center gap-3">
                    <button class="w-11 h-11 bg-white border border-slate-200 rounded-[14px] flex items-center justify-center text-slate-400 hover:text-slate-600 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    </button>
                    <div class="flex bg-white border border-slate-200 rounded-[14px] p-1 shadow-sm">
                        <button class="px-5 py-2 text-sm font-semibold rounded-[10px] text-slate-500 hover:text-slate-700">Semua</button>
                        <button class="px-5 py-2 text-sm font-semibold rounded-[10px] bg-blue-600 text-white shadow-sm">Aktif</button>
                        <button class="px-5 py-2 text-sm font-semibold rounded-[10px] text-slate-500 hover:text-slate-700">Sudah Dinilai</button>
                    </div>
                </div>
            </div>

            <div class="space-y-4 pb-10">
                @forelse($assignments ?? [] as $assignment)
                   <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-16 mt-6">
                            <div>
                                <div class="flex justify-between items-center text-xs font-bold text-slate-700 mb-2">
                                    <span>Pengumpulan</span>
                                    <span>{{ $assignment->submissions_count }} / {{ $totalSiswa }}</span>
                                </div>
                                @php 
                                    // Rumus: (Ngumpulin / Total Siswa) * 100
                                    $pengumpulanPersen = ($assignment->submissions_count / $totalSiswa) * 100; 
                                @endphp
                                <div class="w-full bg-slate-100 rounded-full h-2">
                                    <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $pengumpulanPersen }}%"></div>
                                </div>
                                <p class="text-[10px] text-slate-400 mt-1.5 font-medium">{{ round($pengumpulanPersen) }}% terkumpul</p>
                            </div>

                            <div>
                                <div class="flex justify-between items-center text-xs font-bold text-slate-700 mb-2">
                                    <span>Penilaian</span>
                                    <span>{{ $assignment->graded_count }} / {{ $assignment->submissions_count }}</span>
                                </div>
                                @php 
                                    // Rumus: (Sudah Dinilai / Ngumpulin) * 100
                                    $penilaianPersen = $assignment->submissions_count > 0 ? ($assignment->graded_count / $assignment->submissions_count) * 100 : 0; 
                                @endphp
                                <div class="w-full bg-slate-100 rounded-full h-2">
                                    <div class="bg-emerald-500 h-2 rounded-full" style="width: {{ $penilaianPersen }}%"></div>
                                </div>
                                <p class="text-[10px] text-slate-400 mt-1.5 font-medium">{{ round($penilaianPersen) }}% dinilai</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-16">
                            <div>
                                <div class="flex justify-between items-center text-xs font-bold text-slate-700 mb-2">
                                    <span>Pengumpulan</span>
                                    <span>{{ $assignment->submissions_count ?? 18 }}/62</span>
                                </div>
                                @php 
                                    $pengumpulanPersen = ($assignment->submissions_count ?? 18) / 62 * 100; 
                                @endphp
                                <div class="w-full bg-slate-100 rounded-full h-2">
                                    <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $pengumpulanPersen }}%"></div>
                                </div>
                                <p class="text-[10px] text-slate-400 mt-1.5 font-medium">{{ round($pengumpulanPersen) }}% terkumpul</p>
                            </div>

                            <div>
                                <div class="flex justify-between items-center text-xs font-bold text-slate-700 mb-2">
                                    <span>Penilaian</span>
                                    <span>{{ $assignment->graded_count ?? 12 }}/{{ $assignment->submissions_count ?? 18 }}</span>
                                </div>
                                @php 
                                    $penilaianPersen = ($assignment->submissions_count ?? 18) > 0 ? (($assignment->graded_count ?? 12) / ($assignment->submissions_count ?? 18)) * 100 : 0; 
                                @endphp
                                <div class="w-full bg-slate-100 rounded-full h-2">
                                    <div class="bg-emerald-500 h-2 rounded-full" style="width: {{ $penilaianPersen }}%"></div>
                                </div>
                                <p class="text-[10px] text-slate-400 mt-1.5 font-medium">{{ round($penilaianPersen) }}% dinilai</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white border border-slate-100 rounded-[24px] p-10 text-center">
                        <div class="w-16 h-16 bg-slate-50 text-slate-300 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        </div>
                        <h4 class="text-lg font-bold text-slate-800">Belum ada tugas</h4>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>