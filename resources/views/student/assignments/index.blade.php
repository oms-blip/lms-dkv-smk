<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full bg-white pb-2">
            <div class="relative w-full md:w-96">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input oninput="window.dispatchEvent(new CustomEvent('update-search', {detail: this.value}))" type="text" class="block w-full pl-11 pr-4 py-2.5 border border-slate-200 rounded-full text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-slate-900 placeholder-slate-400 shadow-sm" placeholder="Cari materi, tugas, atau modul...">
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-black text-slate-900">{{ Auth::user()->name }}</p>
                    <p class="text-xs font-bold text-slate-400">Siswa DKV</p>
                </div>
                <div class="w-10 h-10 rounded-full border-2 border-blue-100 bg-gradient-to-tr from-blue-500 to-indigo-500 text-white flex items-center justify-center font-black shadow-sm">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen" x-data="{ filter: 'semua', search: '' }" @update-search.window="search = $event.detail">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm text-center">
                    <h3 class="text-4xl font-black text-amber-500 mb-1">{{ $totalBelum }}</h3>
                    <p class="text-sm font-bold text-slate-500">Belum Mulai</p>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm text-center">
                    <h3 class="text-4xl font-black text-blue-500 mb-1">{{ $totalMenunggu }}</h3>
                    <p class="text-sm font-bold text-slate-500">Menunggu Nilai</p>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm text-center">
                    <h3 class="text-4xl font-black text-emerald-500 mb-1">{{ $totalSelesai }}</h3>
                    <p class="text-sm font-bold text-slate-500">Selesai</p>
                </div>
            </div>


            <div class="space-y-4">
                @forelse($assignments as $assignment)
                    @php
                        $submission = $submissions->get($assignment->id);
                        if($submission) {
                            if($submission->status == 'Sudah Dinilai') {
                                $status = 'Selesai';
                                $badgeColor = 'bg-emerald-50 text-emerald-600 border-emerald-100';
                                $borderColor = 'border-l-4 border-emerald-500';
                                $btnText = 'Lihat Penilaian';
                                $btnClass = 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50';
                            } else {
                                $status = 'Menunggu Penilaian';
                                $badgeColor = 'bg-blue-50 text-blue-600 border-blue-100';
                                $borderColor = 'border-l-4 border-blue-500';
                                $btnText = 'Lihat Status';
                                $btnClass = 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50';
                            }
                        } else {
                            $status = 'Belum Dimulai';
                            $badgeColor = 'bg-amber-50 text-amber-600 border-amber-100';
                            $borderColor = 'border-l-4 border-amber-400';
                            // 👇 TULISAN TOMBOL SUDAH DIGANTI JADI KERJAKAN 👇
                            $btnText = 'Kerjakan'; 
                            $btnClass = 'bg-blue-600 text-white hover:bg-blue-700 shadow-sm';
                        }
                    @endphp

                    <div x-show="(filter === 'semua' || filter === '{{ $status }}') && {{ json_encode(strtolower($assignment->title)) }}.includes(search.toLowerCase())" style="display:none;" class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 {{ $borderColor }} flex flex-col md:flex-row justify-between gap-6 transition-all hover:shadow-md">
                        <div class="flex-1">
                            <div class="flex items-start justify-between mb-2">
                                <div>
                                    <h4 class="text-lg font-black text-slate-800">{{ $assignment->title }}</h4>
                                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-0.5">{{ $assignment->course->title ?? 'Tugas Umum' }}</p>
                                </div>
                                <span class="md:hidden px-3 py-1 rounded-full text-[10px] font-bold border {{ $badgeColor }}">{{ $status }}</span>
                            </div>
                            <p class="text-sm text-slate-600 mt-3 leading-relaxed line-clamp-2">{{ $assignment->description }}</p>
                            <div class="flex items-center gap-4 mt-4">
                                <div class="flex items-center gap-1.5 text-xs font-semibold text-slate-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Deadline: {{ \Carbon\Carbon::parse($assignment->deadline)->translatedFormat('d M Y') }}
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col justify-between items-end shrink-0 border-t md:border-t-0 border-slate-100 pt-4 md:pt-0">
                            <span class="hidden md:inline-block px-3 py-1 rounded-full text-xs font-bold border {{ $badgeColor }} mb-4">{{ $status }}</span>
                            
                            <a href="{{ route('student.assignments.show', $assignment->id) }}" class="px-6 py-2.5 rounded-xl text-sm font-bold w-full md:w-auto text-center transition-colors {{ $btnClass }}">
                                {{ $btnText }}
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-20 bg-white rounded-2xl border border-dashed border-slate-200">
                        <p class="text-sm text-slate-500">Hore! Saat ini tidak ada tugas yang perlu dikerjakan.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>