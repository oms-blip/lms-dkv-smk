<x-app-layout>
    @php
        // Hitung statistik langsung dari database
        $totalSubmissions = $assignment->submissions->count();
        $needGrading = $assignment->submissions->where('status', 'Menunggu')->count();
        $graded = $assignment->submissions->where('status', 'Sudah Dinilai')->count();
    @endphp

    <div x-data="{ statusFilter: 'semua' }">
        <x-slot name="header">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 w-full bg-white pb-2">
                <div class="flex items-center gap-4">
                    <a href="{{ route('teacher.tasks.index') }}" class="p-2.5 bg-slate-50 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-all shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    </a>
                    <div>
                        <h2 class="text-xl font-bold text-slate-800">Penilaian Tugas</h2>
                        <p class="text-sm text-slate-500 mt-0.5">Berikan skor dan masukan untuk hasil karya siswa.</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-2 text-sm">
                    <span class="text-slate-500 font-medium mr-2 text-xs uppercase tracking-wider">Filter Status:</span>
                    <button @click="statusFilter = 'semua'" :class="statusFilter === 'semua' ? 'bg-blue-50 text-blue-600 font-bold border-blue-100' : 'bg-white text-slate-500 hover:bg-slate-50 border-slate-200'" class="px-4 py-2 border rounded-lg transition-all">Semua</button>
                    <button @click="statusFilter = 'menunggu'" :class="statusFilter === 'menunggu' ? 'bg-blue-50 text-blue-600 font-bold border-blue-100' : 'bg-white text-slate-500 hover:bg-slate-50 border-slate-200'" class="px-4 py-2 border rounded-lg transition-all">Belum Dinilai</button>
                </div>
            </div>
        </x-slot>

        <div class="py-8 bg-slate-50 min-h-screen">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
                
                <div class="bg-white rounded-[1.5rem] border border-slate-200 shadow-sm p-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div class="flex items-start gap-4">
                        <div class="w-14 h-14 bg-blue-600 text-white rounded-2xl flex items-center justify-center shrink-0 shadow-lg shadow-blue-200">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-slate-800 mb-1">{{ $assignment->title }}</h2>
                            <p class="text-sm text-slate-500 font-medium">Materi: {{ $assignment->course->title ?? 'Tugas Umum' }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-6 md:border-l border-slate-100 md:pl-6">
                        <div class="text-center">
                            <p class="text-2xl font-black text-slate-800">{{ $totalSubmissions }}</p>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">Terkumpul</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-black text-amber-500">{{ $needGrading }}</p>
                            <p class="text-[10px] font-bold text-amber-500 uppercase tracking-widest mt-0.5">Perlu Nilai</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-black text-emerald-500">{{ $graded }}</p>
                            <p class="text-[10px] font-bold text-emerald-500 uppercase tracking-widest mt-0.5">Selesai</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-[1.5rem] border border-slate-200 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-slate-600">
                            <thead class="bg-slate-50 border-b border-slate-100 text-[11px] uppercase tracking-widest text-slate-400 font-bold">
                                <tr>
                                    <th class="px-6 py-4">Nama Siswa</th>
                                    <th class="px-6 py-4">Waktu</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4 text-center">Skor</th>
                                    <th class="px-6 py-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($assignment->submissions as $submission)
                                    @php
                                        // Ambil 2 huruf pertama nama siswa
                                        $initials = strtoupper(substr($submission->student->name ?? 'S', 0, 2));
                                        $statusClass = strtolower($submission->status);
                                    @endphp
                                    <tr x-show="statusFilter === 'semua' || (statusFilter === 'menunggu' && '{{ $statusClass }}' === 'menunggu')" class="hover:bg-slate-50/50 transition">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-full bg-slate-100 text-slate-600 font-bold flex items-center justify-center relative">
                                                    {{ $initials }}
                                                    <span class="absolute bottom-0 right-0 w-2.5 h-2.5 {{ $submission->status == 'Sudah Dinilai' ? 'bg-emerald-500' : 'bg-amber-500' }} border-2 border-white rounded-full"></span>
                                                </div>
                                                <div>
                                                    <p class="font-bold text-slate-800 text-sm">{{ $submission->student->name ?? 'Siswa' }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <p class="font-medium text-slate-700">{{ $submission->created_at->translatedFormat('d M Y') }}</p>
                                            <p class="text-xs text-slate-400">{{ $submission->created_at->format('H:i') }} WIB</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($submission->status == 'Sudah Dinilai')
                                                <span class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-bold uppercase rounded-md">Sudah Dinilai</span>
                                            @else
                                                <span class="px-3 py-1 bg-amber-50 text-amber-600 text-[10px] font-bold uppercase rounded-md">Menunggu</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-center font-black {{ $submission->score ? 'text-emerald-600 text-base' : 'text-slate-300' }}">
                                            {{ $submission->score ?? '--' }}
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="{{ route('teacher.tasks.grade.student', [$assignment->id, $submission->id]) }}" class="inline-flex items-center gap-1.5 px-4 py-2 {{ $submission->status == 'Menunggu' ? 'bg-blue-600 hover:bg-blue-700 text-white' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50' }} text-xs font-bold rounded-lg transition shadow-sm">
                                                @if($submission->status == 'Menunggu')
                                                    Berikan Nilai
                                                @else
                                                    Lihat Detail
                                                @endif
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-8 text-center text-slate-500 text-sm">
                                            Belum ada siswa yang mengumpulkan tugas ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>