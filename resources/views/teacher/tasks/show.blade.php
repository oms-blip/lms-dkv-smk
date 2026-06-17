<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4 w-full bg-white pb-2">
            <a href="{{ route('teacher.tasks.index') }}" class="p-2.5 bg-slate-50 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-all shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div class="flex justify-between items-center w-full">
                <div>
                    <h2 class="text-xl font-bold text-slate-800">Detail Tugas</h2>
                    <p class="text-sm text-slate-500 mt-0.5">Lihat instruksi lengkap dan status pengumpulan.</p>
                </div>
                <a href="{{ route('teacher.tasks.edit', $assignment->id) }}" class="px-4 py-2 bg-white border border-slate-200 text-slate-600 rounded-lg text-sm font-bold hover:bg-slate-50 transition shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                Edit Tugas
            </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-[1.5rem] border border-slate-200 shadow-sm p-8">
                        
                        <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-lg text-[10px] font-bold uppercase tracking-widest inline-block mb-4">
                            {{ $assignment->course->title ?? 'Tugas Umum' }}
                        </span>
                        
                        <h1 class="text-3xl font-black text-slate-800 mb-4">{{ $assignment->title }}</h1>
                        
                        <div class="flex flex-wrap items-center gap-4 text-sm mb-8 pb-6 border-b border-slate-100">
                            <div class="flex items-center text-slate-500 font-medium">
                                <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                Semua Kelas Terdaftar
                            </div>
                            <div class="flex items-center text-rose-500 font-bold bg-rose-50 px-3 py-1 rounded-full">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Deadline: {{ \Carbon\Carbon::parse($assignment->deadline)->translatedFormat('d M Y, H:i') }} WIB
                            </div>
                        </div>

                        <h3 class="text-lg font-bold text-slate-800 mb-3">Instruksi Tugas:</h3>
                        <div class="prose prose-sm text-slate-600 max-w-none leading-relaxed mb-8 whitespace-pre-line">
                            {{ $assignment->description }}
                        </div>

                        @if(!empty($assignment->file_path) || !empty($assignment->link_url))
                            <h3 class="text-sm font-bold text-slate-800 mb-3 border-t border-slate-100 pt-6">Lampiran Referensi:</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                
                                @if(!empty($assignment->file_path))
                                <a href="{{ Storage::url($assignment->file_path) }}" target="_blank" class="flex items-center gap-4 p-4 rounded-xl border border-slate-200 hover:border-blue-300 hover:bg-blue-50 transition group">
                                    <div class="w-12 h-12 bg-rose-50 text-rose-500 rounded-lg flex items-center justify-center group-hover:bg-rose-100 transition">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 6H7a2 2 0 00-2 2v11a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-700 group-hover:text-blue-700 transition">File PDF Tugas</p>
                                        <p class="text-[11px] text-slate-400">Klik untuk melihat/unduh</p>
                                    </div>
                                </a>
                                @endif

                                @if(!empty($assignment->link_url))
                                <a href="{{ $assignment->link_url }}" target="_blank" class="flex items-center gap-4 p-4 rounded-xl border border-slate-200 hover:border-blue-300 hover:bg-blue-50 transition group">
                                    <div class="w-12 h-12 bg-indigo-50 text-indigo-500 rounded-lg flex items-center justify-center group-hover:bg-indigo-100 transition">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-700 group-hover:text-blue-700 transition">Link Eksternal</p>
                                        <p class="text-[11px] text-slate-400">Buka tautan terkait</p>
                                    </div>
                                </a>
                                @endif

                            </div>
                        @endif

                    </div>
                </div>

                <div class="lg:col-span-1 space-y-6">
                    
                    <div class="bg-white rounded-[1.5rem] border border-slate-200 shadow-sm p-6 sticky top-6">
                        <h3 class="text-base font-bold text-slate-800 flex items-center gap-2 mb-6">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            Ringkasan Pengumpulan
                        </h3>

                        <div class="space-y-4 mb-6">
                            <div>
                                <div class="flex justify-between items-end mb-1">
                                    <span class="text-xs font-bold text-slate-600">Terkumpul</span>
                                    <span class="text-xs font-bold text-slate-800">0 / 0</span>
                                </div>
                                <div class="w-full bg-slate-100 h-2 rounded-full">
                                    <div class="bg-blue-500 h-2 rounded-full" style="width: 0%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between items-end mb-1">
                                    <span class="text-xs font-bold text-slate-600">Sudah Dinilai</span>
                                    <span class="text-xs font-bold text-slate-800">0 / 0</span>
                                </div>
                                <div class="w-full bg-slate-100 h-2 rounded-full">
                                    <div class="bg-emerald-500 h-2 rounded-full" style="width: 0%"></div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-amber-50 border border-amber-200 text-amber-700 px-4 py-3 rounded-xl text-xs font-medium mb-6 flex items-start gap-2">
                            <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            <span>Belum ada siswa yang mengumpulkan tugas ini.</span>
                        </div>

                        <a href="{{ route('teacher.tasks.grade', $assignment->id) }}" class="w-full py-3 bg-blue-600 text-white rounded-xl text-sm font-bold hover:bg-blue-700 transition shadow-sm shadow-blue-200 flex justify-center items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            Mulai Penilaian
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>