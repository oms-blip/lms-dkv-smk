<x-app-layout>
    @php
        // Siapkan data dinamis yang dibutuhkan
        $inisial = strtoupper(substr($student->name, 0, 2));
        $totalAssignments = \App\Models\Assignment::count();
        $progress = $totalAssignments > 0 ? round(($tugasSelesai / $totalAssignments) * 100) : 0;
        
        // Logika status siswa
        $statusAktif = ($tugasSelesai > 0 && $rataRata >= 70) ? 'Aktif' : 'Perlu Perhatian';
        $statusWarna = $statusAktif == 'Aktif' ? 'text-emerald-600' : 'text-rose-600';
    @endphp

    <x-slot name="header">
        <div class="flex items-center gap-4 w-full bg-white">
            <a href="{{ route('teacher.students.index') }}" class="p-2.5 bg-slate-50 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h2 class="text-xl font-bold text-slate-800">Detail Perkembangan Siswa</h2>
                <p class="text-sm text-slate-500 mt-0.5">Pantau nilai, tugas, dan keaktifan siswa secara mendalam.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white rounded-[1.5rem] border border-slate-200 p-6 shadow-sm text-center">
                        
                        <div class="w-24 h-24 rounded-full bg-slate-100 border-4 border-slate-50 mx-auto flex items-center justify-center font-black text-3xl text-slate-600 shadow-sm mb-4">
                            {{ $inisial }}
                        </div>
                        
                        <h3 class="text-xl font-bold text-slate-800 capitalize">{{ $student->name }}</h3>
                        <p class="text-xs font-semibold text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full inline-block mt-1.5 border border-indigo-100">
                            Kelas X DKV
                        </p>

                        <div class="h-px bg-slate-100 my-6"></div>

                        <div class="grid grid-cols-3 gap-2 text-center mb-6">
                            <div class="p-2 bg-slate-50/50 rounded-xl border border-slate-100">
                                <p class="text-xl font-black text-slate-800">{{ $progress }}%</p>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mt-1">Progress</p>
                            </div>
                            <div class="p-2 bg-slate-50/50 rounded-xl border border-slate-100">
                                <p class="text-xl font-black text-slate-800">{{ round($rataRata) }}</p>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mt-1">Rata-Rata</p>
                            </div>
                            <div class="p-2 bg-slate-50/50 rounded-xl border border-slate-100">
                                <p class="text-xl font-black text-slate-800">{{ $tugasSelesai }}/{{ $totalAssignments }}</p>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mt-1">Tugas</p>
                            </div>
                        </div>

                        <div class="text-left space-y-3 text-xs font-medium text-slate-500 bg-slate-50 p-4 rounded-xl">
                            <div class="flex justify-between items-center">
                                <span>Status Keaktifan:</span>
                                <span class="font-bold {{ $statusWarna }} bg-white px-2 py-1 rounded-md shadow-sm">{{ $statusAktif }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Terakhir Aktif:</span>
                                <span class="font-bold text-slate-700">{{ $student->updated_at ? $student->updated_at->diffForHumans() : 'Belum Pernah' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Email Siswa:</span>
                                <span class="font-bold text-slate-700 text-right">{{ $student->email }}</span>
                            </div>
                        </div>

                        <a href="mailto:{{ $student->email }}" class="w-full mt-4 inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-800 text-white font-bold text-xs rounded-xl hover:bg-slate-900 transition shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            Kirim Email
                        </a>

                    </div>
                </div>

                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-[1.5rem] border border-slate-200 shadow-sm p-6 sm:p-8">
                        <h3 class="text-base font-bold text-slate-800 mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 002-2h2a2 2 0 002 2"></path></svg>
                            Riwayat Nilai Tugas Mandiri
                        </h3>

                        <div class="space-y-4">
                            @forelse($submissions as $index => $sub)
                                <div class="flex items-center justify-between p-4 border border-slate-100 rounded-2xl hover:bg-slate-50/50 transition">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-sm shrink-0">
                                            {{ $index + 1 }}
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-bold text-slate-800">{{ $sub->assignment->title ?? 'Tugas Tidak Diketahui' }}</h4>
                                            <p class="text-[11px] text-slate-400 mt-0.5">Dikumpulkan: {{ $sub->created_at->format('d M Y, H:i') }} WIB</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-lg font-black {{ $sub->score ? 'text-emerald-600' : 'text-amber-500' }}">
                                            {{ $sub->score ?? '--' }}
                                        </span>
                                        <p class="text-[10px] font-bold uppercase tracking-wider {{ $sub->status == 'Sudah Dinilai' ? 'text-emerald-500' : 'text-amber-500' }} mt-0.5">
                                            {{ $sub->status }}
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-10 bg-slate-50 rounded-2xl border border-slate-100 border-dashed">
                                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mx-auto mb-3 shadow-sm">
                                        <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                    </div>
                                    <p class="text-sm font-bold text-slate-500">Belum Ada Riwayat</p>
                                    <p class="text-xs text-slate-400 mt-1">Siswa ini belum mengumpulkan tugas apapun.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>