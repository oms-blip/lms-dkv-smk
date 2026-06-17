<x-app-layout>
    <div x-data="{ searchQuery: '', activeFilter: 'semua' }" class="p-8 bg-[#f8fafc] min-h-screen">
        
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-slate-200 pb-6 mb-8">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-[#f0f0fe] rounded-2xl flex items-center justify-center text-[#5f5ce6]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-slate-800">Data Siswa</h2>
                        <p class="text-sm text-slate-500 mt-0.5">Monitoring progress dan performa seluruh siswa DKV.</p>
                    </div>
                </div>
                
                <button onclick="alert('Fitur Export Data sedang diproses bos!')" class="bg-[#1e293b] text-white px-5 py-2.5 rounded-[14px] text-sm font-semibold hover:bg-slate-700 transition-all flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Export Data
                </button>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.05)] text-center">
                    <p class="text-[40px] font-bold text-[#5f5ce6] mb-2 leading-none">{{ $totalSiswa ?? 0 }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Siswa</p>
                </div>
                <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.05)] text-center">
                    <p class="text-[40px] font-bold text-emerald-500 mb-2 leading-none">{{ $rataRataKelas ?? 0 }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Rata-rata Nilai</p>
                </div>
                <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.05)] text-center">
                    <p class="text-[40px] font-bold text-[#5f5ce6] mb-2 leading-none">{{ $siswaAktif ?? 0 }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Siswa Aktif</p>
                </div>
                <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.05)] text-center">
                    <p class="text-[40px] font-bold text-rose-500 mb-2 leading-none">{{ $perluPerhatian ?? 0 }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Perlu Perhatian</p>
                </div>
            </div>

            <div class="flex flex-col md:flex-row gap-6 mb-8">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" x-model="searchQuery" class="w-full pl-12 pr-4 py-3 bg-white border border-slate-200 rounded-2xl text-sm focus:ring-2 focus:ring-[#5f5ce6] focus:border-[#5f5ce6] outline-none transition-all shadow-sm" placeholder="Cari nama siswa...">
                </div>

                <div class="flex items-center gap-3 overflow-x-auto pb-2 md:pb-0">
                    <svg class="w-5 h-5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    <button @click="activeFilter = 'semua'" :class="activeFilter === 'semua' ? 'bg-[#5f5ce6] text-white border-transparent' : 'bg-white text-slate-600 border-slate-200 hover:bg-slate-50'" class="px-5 py-2.5 rounded-xl text-sm font-semibold border shadow-sm transition-all shrink-0">Semua</button>
                    <button @click="activeFilter = 'x_dkv_1'" :class="activeFilter === 'x_dkv_1' ? 'bg-[#5f5ce6] text-white border-transparent' : 'bg-white text-slate-600 border-slate-200 hover:bg-slate-50'" class="px-5 py-2.5 rounded-xl text-sm font-semibold border shadow-sm transition-all shrink-0">X DKV 1</button>
                    <button @click="activeFilter = 'x_dkv_2'" :class="activeFilter === 'x_dkv_2' ? 'bg-[#5f5ce6] text-white border-transparent' : 'bg-white text-slate-600 border-slate-200 hover:bg-slate-50'" class="px-5 py-2.5 rounded-xl text-sm font-semibold border shadow-sm transition-all shrink-0">X DKV 2</button>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                @forelse($students as $student)
                    @php
                        // Membuat inisial nama (maksimal 2 huruf awal)
                        $inisial = strtoupper(substr($student->name, 0, 2));
                        
                        // MENGAMBIL DATA KELAS ASLI DARI DATABASE
                        $kelasAsli = $student->kelas ?? 'Belum Diatur';
                        
                        // Gabungkan dengan huruf X (Contoh: X DKV 1)
                        $namaKelas = 'X ' . $kelasAsli; 
                        
                        // Mengubah nama kelas jadi format kode untuk filter (Jadi: x_dkv_1 atau x_dkv_2)
                        $kodeFilterKelas = strtolower(str_replace(' ', '_', $namaKelas));
                    @endphp

                    <div x-data="{ nama: '{{ addslashes($student->name) }}', kelas: '{{ $kodeFilterKelas }}' }" 
                         x-show="(activeFilter === 'semua' || activeFilter === kelas) && nama.toLowerCase().includes(searchQuery.toLowerCase())" 
                         x-transition.opacity.duration.300ms
                         class="bg-white p-6 rounded-[24px] border border-slate-100 shadow-sm flex flex-col hover:shadow-md transition-shadow">
                        
                        <div class="flex justify-between items-start mb-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-700 font-bold flex items-center justify-center text-lg">
                                    {{ $inisial }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800 text-base capitalize">{{ $student->name }}</h4>
                                    <p class="text-xs text-slate-400 font-medium uppercase">{{ $namaKelas }}</p>
                                </div>
                            </div>
                            
                            @if(isset($student->rata_rata) && $student->rata_rata > 0 && $student->rata_rata < 70)
                                <span class="px-3 py-1.5 bg-rose-50 text-rose-500 text-[10px] font-bold rounded-full flex items-center gap-1.5">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg> Perlu Perhatian
                                </span>
                            @else
                                <span class="px-3 py-1.5 bg-emerald-50 text-emerald-500 text-[10px] font-bold rounded-full flex items-center gap-1.5">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Aktif
                                </span>
                            @endif
                        </div>

                        <div class="grid grid-cols-3 gap-4 mb-4">
                            <div class="text-center">
                                <p class="text-[22px] font-bold text-slate-800">{{ $student->progress ?? 0 }}%</p>
                                <p class="text-[10px] text-slate-400 font-medium mt-1">Progress</p>
                            </div>
                            <div class="text-center">
                                <p class="text-[22px] font-bold {{ (isset($student->rata_rata) && $student->rata_rata < 70 && $student->tugas_selesai > 0) ? 'text-rose-500' : 'text-slate-800' }} flex items-center justify-center gap-1">
                                    {{ $student->rata_rata ?? 0 }} 
                                </p>
                                <p class="text-[10px] text-slate-400 font-medium mt-1">Rata-rata</p>
                            </div>
                            <div class="text-center">
                                <p class="text-[22px] font-bold text-slate-800">{{ $student->tugas_selesai ?? 0 }}/{{ $student->total_tugas ?? 0 }}</p>
                                <p class="text-[10px] text-slate-400 font-medium mt-1">Tugas</p>
                            </div>
                        </div>

                        <div class="w-full bg-slate-100 rounded-full h-1.5 mb-2">
                            <div class="bg-[#059669] h-1.5 rounded-full transition-all duration-1000" style="width: {{ $student->progress ?? 0 }}%"></div>
                        </div>
                        
                        <p class="text-[10px] text-slate-400 font-medium mb-6">Terakhir aktif: {{ $student->updated_at ? $student->updated_at->diffForHumans() : 'Baru saja' }}</p>

                        <div class="flex gap-3 mt-auto">
                            <a href="{{ route('teacher.students.show', $student->id) }}" class="flex-1 py-3 bg-[#f0f0fe] text-[#5f5ce6] rounded-xl text-[13px] font-bold flex items-center justify-center gap-2 hover:bg-[#e0e0fc] active:scale-95 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                Detail
                            </a>
                            <a href="mailto:{{ $student->email }}" class="flex-1 py-3 bg-slate-50 text-slate-700 rounded-xl text-[13px] font-bold flex items-center justify-center gap-2 hover:bg-slate-100 active:scale-95 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                Pesan
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 lg:col-span-2 text-center py-16 bg-white rounded-[24px] border border-slate-200 border-dashed">
                        <div class="w-16 h-16 bg-slate-50 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <h3 class="text-base font-bold text-slate-700 mb-1">Belum ada data siswa</h3>
                        <p class="text-sm text-slate-500">Siswa yang mendaftar akan otomatis muncul di sini.</p>
                    </div>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>