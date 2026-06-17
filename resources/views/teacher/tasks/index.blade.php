<x-app-layout>
   <div x-data="{ activeTab: localStorage.getItem('tabKelolaTugas') || 'aktif', searchQuery: '' }" 
     x-init="$watch('activeTab', val => localStorage.setItem('tabKelolaTugas', val))" 
     class="min-h-screen bg-slate-50">
        
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
                    <div class="relative" x-data="{ openNotif: false }">
                        @php $jumlahNotif = 0; @endphp 
                        <button @click="openNotif = !openNotif" @click.away="openNotif = false" class="relative text-slate-400 hover:text-blue-600 transition-colors p-2 rounded-full hover:bg-slate-100 outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            @if($jumlahNotif > 0)
                                <span class="absolute top-1 right-1 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-[9px] font-bold text-white border-2 border-white">{{ $jumlahNotif }}</span>
                            @endif
                        </button>
                        <div x-show="openNotif" x-transition class="absolute right-0 mt-2 w-80 bg-white rounded-2xl border border-slate-200 shadow-xl z-50 py-2 text-sm text-slate-600" style="display: none;">
                            <div class="px-4 py-2 font-bold text-slate-800 border-b border-slate-100">Notifikasi Tugas</div>
                            <div class="p-4 text-center text-slate-400 text-xs">Belum ada pengumpulan tugas baru dari siswa.</div>
                        </div>
                    </div>

                    <div class="flex items-center space-x-3 border-l border-slate-200 pl-4">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-bold text-slate-800">{{ auth()->user()->name ?? 'Guru DKV' }}</p>
                            <p class="text-[11px] text-slate-400 font-medium">Panel Guru</p>
                        </div>
                        <img class="w-10 h-10 rounded-full object-cover ring-2 ring-slate-100" src="https://ui-avatars.com/api/?name=Guru+DKV&background=f1f5f9" alt="Profile">
                    </div>
                </div>
            </div>
        </x-slot>

        <div class="p-8">
            <div class="max-w-7xl mx-auto space-y-8">

                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        </div>
                    <a href="{{ route('teacher.tasks.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl font-bold text-sm shadow-lg shadow-blue-600/20 flex items-center transition-all shrink-0">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Buat Tugas Baru
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center space-x-4">
                        <div class="p-3 bg-blue-50 text-blue-600 rounded-xl"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg></div>
                        <div><p class="text-2xl font-black text-slate-800">{{ $totalTugas }}</p><p class="text-xs font-medium text-slate-400">Total Tugas Buatan</p></div>
                    </div>
                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center space-x-4">
                        <div class="p-3 bg-amber-50 text-amber-600 rounded-xl"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                        <div><p class="text-2xl font-black text-slate-800">{{ $menungguDinilai }}</p><p class="text-xs font-medium text-slate-400">Menunggu Dinilai</p></div>
                    </div>
                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center space-x-4">
                        <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                        <div><p class="text-2xl font-black text-slate-800">{{ $selesaiDinilai }}</p><p class="text-xs font-medium text-slate-400">Tugas Selesai Dinilai</p></div>
                    </div>
                </div>

                <div class="relative w-full max-w-2xl">
                    <input type="text" x-model="searchQuery" class="w-full pl-12 pr-4 py-3.5 bg-white border border-slate-200 rounded-[16px] focus:ring-blue-500 focus:border-blue-500 shadow-sm text-sm outline-none" placeholder="Cari judul atau modul tugas...">
                    <svg class="absolute left-4 top-4 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>

                <div class="flex items-center space-x-3 border-b border-slate-100 pb-2">
                    <button @click="activeTab = 'semua'" :class="activeTab === 'semua' ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'" class="px-5 py-2 rounded-xl text-xs font-bold transition-all outline-none">
                        Semua
                    </button>
                    <button @click="activeTab = 'aktif'" :class="activeTab === 'aktif' ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'" class="px-5 py-2 rounded-xl text-xs font-bold transition-all outline-none">
                        Aktif
                    </button>
                    <button @click="activeTab = 'tidak_aktif'" :class="activeTab === 'tidak_aktif' ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'" class="px-5 py-2 rounded-xl text-xs font-bold transition-all outline-none">
                        Tidak Aktif
                    </button>
                </div>

                <div class="space-y-4">
                    @php
                        $daftarTugas = $assignments ?? [];
                        $totalTugasCount = count($daftarTugas);
                    @endphp

                    @if($totalTugasCount > 0)
                        @foreach($daftarTugas as $task)
                            @php
                                // LOGIKA BARU: Mengecek apakah waktu sekarang sudah MELEWATI deadline tugas
                                $sudahLewatDeadline = \Carbon\Carbon::parse($task->deadline ?? $task->due_date)->isPast();
                                
                                // Tentukan status berdasarkan waktu kedaluwarsa
                                $statusTugas = $sudahLewatDeadline ? 'tidak_aktif' : 'aktif';
                            @endphp
                            
                            <div x-data="{ title: '{{ strtolower($task->title) }}', status: '{{ $statusTugas }}' }"
                                 x-show="(activeTab === 'semua' || activeTab === status) && (searchQuery === '' || title.includes(searchQuery.toLowerCase()))"
                                 x-transition
                                 class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 hover:border-slate-200 transition-colors">
                               <div>
                                        <span class="px-2 py-0.5 text-[10px] font-bold rounded-md {{ $statusTugas === 'aktif' ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }} uppercase mb-2 inline-block">
                                            {{ $statusTugas === 'aktif' ? 'Aktif / Berjalan' : 'Tidak Aktif / Ditutup' }}
                                        </span>

                                        <h4 class="font-bold text-slate-800 text-base flex items-center gap-2">
                                            {{ $task->title }}
                                            
                                            @if($task->submissions_count > 0 && $task->submissions_count == $task->graded_count)
                                                <span class="px-2 py-0.5 bg-blue-50 text-blue-600 text-[9px] font-bold rounded-lg flex items-center gap-1">
                                                    Semua Ter-Nilai
                                                </span>
                                            @elseif($task->submissions_count > 0)
                                                <span class="px-2 py-0.5 bg-amber-50 text-amber-600 text-[9px] font-bold rounded-lg">
                                                    {{ $task->graded_count }} / {{ $task->submissions_count }} Dinilai
                                                </span>
                                            @endif
                                        </h4>

                                        <p class="text-xs mt-1 {{ $statusTugas === 'aktif' ? 'text-slate-400' : 'text-rose-400 font-bold' }}">
                                            Batas Pengumpulan: {{ \Carbon\Carbon::parse($task->deadline ?? $task->due_date)->format('d M Y, H:i') }} WIB
                                        </p>
                                    </div>
                                
                                <div class="flex flex-wrap items-center gap-2 w-full sm:w-auto justify-end mt-4 sm:mt-0">
                                    <a href="{{ route('teacher.tasks.show', $task->id) }}" class="px-4 py-2 bg-slate-50 border border-slate-200 text-slate-600 rounded-xl text-xs font-bold hover:bg-slate-100 transition-colors">
                                        Lihat Detail
                                    </a>
                                    <a href="{{ route('teacher.tasks.grade', $task->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded-xl text-xs font-bold hover:bg-blue-700 transition-colors shadow-sm">
                                        Nilai Tugas
                                    </a>
                                    
                                    <form action="{{ route('teacher.tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus tugas ini permanen? Data nilai siswa untuk tugas ini juga akan hilang!');" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-rose-50 border border-rose-200 text-rose-600 rounded-xl text-xs font-bold hover:bg-rose-500 hover:text-white transition-colors flex items-center gap-1.5 shadow-sm">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <div x-show="Array.from($el.parentNode.children).filter(c => c.classList.contains('bg-white') && c.style.display !== 'none').length === 0" 
                         class="text-center py-16 bg-white rounded-2xl border border-slate-200 border-dashed" style="display: none;">
                        <div class="w-16 h-16 bg-slate-50 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        </div>
                        <h3 class="text-base font-bold text-slate-700 mb-1">Belum ada data tugas</h3>
                        <p class="text-xs text-slate-400 max-w-sm mx-auto">Tidak ada tugas dalam kategori ini atau coba gunakan kata kunci pencarian lain.</p>
                    </div>

                </div>

            </div>
        </div>

    </div>
</x-app-layout>