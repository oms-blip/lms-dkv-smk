<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center w-full bg-white pb-2">
            <div class="flex flex-col">
                <div class="flex items-center gap-3 mb-2">
                    <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <h2 class="text-[28px] font-bold text-slate-800 tracking-tight leading-none mt-1">
                        Data Siswa
                    </h2>
                </div>
                <p class="text-sm text-slate-400 font-medium">Monitoring progress dan performa seluruh siswa DKV.</p>
            </div>
            
            <div class="mt-4 sm:mt-0 shrink-0">
                <button onclick="alert('Mendownload data siswa...')" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-[#1e293b] text-white rounded-[0.8rem] text-sm font-semibold hover:bg-slate-900 transition shadow-sm whitespace-nowrap">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Export Data
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen" x-data="{ filterKelas: 'semua', searchQuery: '' }">
        <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                <div class="bg-white rounded-2xl border border-slate-100 p-6 flex flex-col items-center justify-center text-center shadow-sm">
                    <h4 class="text-4xl font-black text-indigo-600 mb-2">1</h4>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Siswa</p>
                </div>
                <div class="bg-white rounded-2xl border border-slate-100 p-6 flex flex-col items-center justify-center text-center shadow-sm">
                    <h4 class="text-4xl font-black text-emerald-500 mb-2">80</h4>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Rata-Rata Nilai</p>
                </div>
                <div class="bg-white rounded-2xl border border-slate-100 p-6 flex flex-col items-center justify-center text-center shadow-sm">
                    <h4 class="text-4xl font-black text-indigo-500 mb-2">4</h4>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Siswa Aktif</p>
                </div>
                <div class="bg-white rounded-2xl border border-slate-100 p-6 flex flex-col items-center justify-center text-center shadow-sm">
                    <h4 class="text-4xl font-black text-rose-500 mb-2">1</h4>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Perlu Perhatian</p>
                </div>
            </div>

          <div class="pt-4">
                <div class="relative w-full max-w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" x-model="searchQuery" class="block w-full py-3 pl-11 pr-4 border border-slate-200 rounded-xl text-sm bg-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder-slate-400 shadow-sm" placeholder="Cari nama siswa...">
                </div>
            </div>

            <div class="flex items-center gap-3 overflow-x-auto pb-2 scrollbar-hide">
                <div class="text-slate-400 p-2 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                </div>
                <button @click="filterKelas = 'semua'" :class="filterKelas === 'semua' ? 'bg-indigo-500 text-white shadow-md' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50'" class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all whitespace-nowrap">Semua</button>
                <button @click="filterKelas = 'xdkv1'" :class="filterKelas === 'xdkv1' ? 'bg-indigo-500 text-white shadow-md' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50'" class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all whitespace-nowrap">X DKV 1</button>
                <button @click="filterKelas = 'xdkv2'" :class="filterKelas === 'xdkv2' ? 'bg-indigo-500 text-white shadow-md' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50'" class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all whitespace-nowrap">X DKV 2</button>
                <button @click="filterKelas = 'xdkv3'" :class="filterKelas === 'xdkv3' ? 'bg-indigo-500 text-white shadow-md' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50'" class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all whitespace-nowrap">X DKV 3</button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                
                <div x-show="(filterKelas === 'semua' || filterKelas === 'xdkv2') && 'siswa dkv'.includes(searchQuery.toLowerCase())" x-transition class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition group flex flex-col">
                    <div class="flex justify-between items-start mb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-full bg-slate-100 border border-slate-200 text-slate-600 flex items-center justify-center font-black text-lg shrink-0">SD</div>
                            <div>
                                <h4 class="font-bold text-slate-800 leading-tight group-hover:text-indigo-600 transition">Siswa DKV</h4>
                                <p class="text-[11px] font-medium text-slate-400 mt-0.5">X DKV 2</p>
                            </div>
                        </div>
                        <span class="flex items-center gap-1 text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-md border border-emerald-100 shrink-0">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Aktif
                        </span>
                    </div>

                    <div class="grid grid-cols-3 gap-2 mb-4 text-center">
                        <div>
                            <p class="text-lg font-black text-slate-800">75%</p>
                            <p class="text-[10px] font-medium text-slate-400">Progress</p>
                        </div>
                        <div>
                            <p class="text-lg font-black text-slate-800 flex justify-center items-center gap-0.5">
                                85 <svg class="w-3 h-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                            </p>
                            <p class="text-[10px] font-medium text-slate-400">Rata-rata</p>
                        </div>
                        <div>
                            <p class="text-lg font-black text-slate-800">7/10</p>
                            <p class="text-[10px] font-medium text-slate-400">Tugas</p>
                        </div>
                    </div>

                    <div class="w-full bg-slate-100 h-1.5 rounded-full mb-3">
                        <div class="bg-emerald-500 h-1.5 rounded-full" style="width: 75%"></div>
                    </div>
                    <p class="text-[10px] font-semibold text-slate-400 mb-6">Terakhir aktif: Hari ini</p>

                    <div class="flex gap-3 mt-auto">
                        <a href="{{ route('teacher.students.show', 1) }}" class="flex-1 py-2.5 border border-indigo-100 text-indigo-600 rounded-xl text-xs font-bold flex items-center justify-center gap-2 hover:bg-indigo-50 transition shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg> Detail
                        </a>
                        <a href="mailto:siswa.dkv@sekolah.com" class="flex-1 py-2.5 bg-slate-50 border border-slate-100 text-slate-600 rounded-xl text-xs font-bold flex items-center justify-center gap-2 hover:bg-slate-100 transition shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg> Pesan
                        </a>
                    </div>
                </div>

                <div x-show="(filterKelas === 'semua' || filterKelas === 'xdkv1') && 'fajar ramadhan'.includes(searchQuery.toLowerCase())" x-transition class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition group flex flex-col">
                    <div class="flex justify-between items-start mb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-full bg-slate-50 border border-slate-200 text-slate-600 flex items-center justify-center font-black text-lg shrink-0">FR</div>
                            <div>
                                <h4 class="font-bold text-slate-800 leading-tight group-hover:text-indigo-600 transition">Fajar Ramadhan</h4>
                                <p class="text-[11px] font-medium text-slate-400 mt-0.5">X DKV 1</p>
                            </div>
                        </div>
                        <span class="flex items-center justify-center text-[10px] font-bold text-rose-600 bg-rose-50 px-3 py-1.5 rounded-md border border-rose-100 uppercase tracking-wide shrink-0">
                            Pasif
                        </span>
                    </div>

                    <div class="grid grid-cols-3 gap-2 mb-4 text-center">
                        <div>
                            <p class="text-lg font-black text-slate-800">20%</p>
                            <p class="text-[10px] font-medium text-slate-400">Progress</p>
                        </div>
                        <div>
                            <p class="text-lg font-black text-slate-800 flex justify-center items-center gap-0.5">
                                58 <svg class="w-3 h-3 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path></svg>
                            </p>
                            <p class="text-[10px] font-medium text-slate-400">Rata-rata</p>
                        </div>
                        <div>
                            <p class="text-lg font-black text-slate-800">2/10</p>
                            <p class="text-[10px] font-medium text-slate-400">Tugas</p>
                        </div>
                    </div>

                    <div class="w-full bg-slate-100 h-1.5 rounded-full mb-3">
                        <div class="bg-rose-500 h-1.5 rounded-full" style="width: 20%"></div>
                    </div>
                    <p class="text-[10px] font-semibold text-slate-400 mb-6">Terakhir aktif: 4 Hari lalu</p>

                    <div class="flex gap-3 mt-auto">
                        <a href="{{ route('teacher.students.show', 2) }}" class="flex-1 py-2.5 border border-indigo-100 text-indigo-600 rounded-xl text-xs font-bold flex items-center justify-center gap-2 hover:bg-indigo-50 transition shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg> Detail
                        </a>
                        <a href="mailto:fajar.ramadhan@sekolah.com" class="flex-1 py-2.5 bg-slate-50 border border-slate-100 text-slate-600 rounded-xl text-xs font-bold flex items-center justify-center gap-2 hover:bg-slate-100 transition shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg> Pesan
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>