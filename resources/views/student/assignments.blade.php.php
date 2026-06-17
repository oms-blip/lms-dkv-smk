<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 w-full">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-600 to-blue-500 flex items-center justify-center shadow-lg shadow-indigo-200 shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                </div>
                <div>
                    <h2 class="font-black text-2xl text-slate-900 tracking-tight leading-none">Tugas & Evaluasi</h2>
                    <p class="text-sm font-medium text-slate-500 mt-1">Pantau tenggat waktu dan kumpulkan hasil karyamu.</p>
                </div>
            </div>

            <div class="relative w-full md:w-80 shrink-0">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" 
                       class="block w-full pl-11 pr-4 py-2.5 border border-slate-200 rounded-full text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-slate-900 placeholder-slate-400 shadow-sm" 
                       placeholder="Cari nama tugas atau mata pelajaran...">
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 lg:gap-6">
                <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 flex items-center gap-5 hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                    <div class="w-14 h-14 rounded-2xl bg-slate-50 border border-slate-100 text-slate-400 flex items-center justify-center shrink-0">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Belum Dimulai</p>
                        <h4 class="text-3xl font-black text-slate-800 leading-none">4</h4> 
                    </div>
                </div>

                <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-amber-100 flex items-center gap-5 hover:shadow-md hover:shadow-amber-100 transition-all duration-300 hover:-translate-y-1 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-amber-50/50 to-transparent pointer-events-none"></div>
                    <div class="w-14 h-14 rounded-2xl bg-amber-100 text-amber-500 flex items-center justify-center shrink-0 relative z-10 shadow-inner">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </div>
                    <div class="relative z-10">
                        <p class="text-xs font-bold text-amber-500 uppercase tracking-widest mb-1">Sedang Dikerjakan</p>
                        <h4 class="text-3xl font-black text-slate-800 leading-none">2</h4> 
                    </div>
                </div>

                <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-emerald-100 flex items-center gap-5 hover:shadow-md hover:shadow-emerald-100 transition-all duration-300 hover:-translate-y-1 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-50/50 to-transparent pointer-events-none"></div>
                    <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-emerald-500 flex items-center justify-center shrink-0 relative z-10 shadow-inner">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="relative z-10">
                        <p class="text-xs font-bold text-emerald-500 uppercase tracking-widest mb-1">Telah Selesai</p>
                        <h4 class="text-3xl font-black text-slate-800 leading-none">12</h4> 
                    </div>
                </div>
            </div>

            <div x-data="{ activeTab: 'semua' }" class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-2 sm:p-4">
                
                <div class="px-4 py-3 border-b border-slate-100 mb-2 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <h3 class="font-black text-lg text-slate-800 tracking-tight">Daftar Semua Tugas</h3>
                    <div class="flex gap-2 w-full sm:w-auto overflow-x-auto scrollbar-hide pb-2 sm:pb-0">
                        <button @click="activeTab = 'semua'" :class="activeTab === 'semua' ? 'bg-indigo-50 text-indigo-600' : 'bg-slate-50 text-slate-500 hover:bg-slate-100'" class="px-4 py-2 rounded-xl text-xs font-bold whitespace-nowrap transition">Semua Status</button>
                        <button @click="activeTab = 'belum'" :class="activeTab === 'belum' ? 'bg-indigo-50 text-indigo-600' : 'bg-slate-50 text-slate-500 hover:bg-slate-100'" class="px-4 py-2 rounded-xl text-xs font-bold whitespace-nowrap transition">Belum Dimulai</button>
                        <button @click="activeTab = 'proses'" :class="activeTab === 'proses' ? 'bg-indigo-50 text-indigo-600' : 'bg-slate-50 text-slate-500 hover:bg-slate-100'" class="px-4 py-2 rounded-xl text-xs font-bold whitespace-nowrap transition">Sedang Dikerjakan</button>
                        <button @click="activeTab = 'selesai'" :class="activeTab === 'selesai' ? 'bg-indigo-50 text-indigo-600' : 'bg-slate-50 text-slate-500 hover:bg-slate-100'" class="px-4 py-2 rounded-xl text-xs font-bold whitespace-nowrap transition">Selesai</button>
                    </div>
                </div>

                <div class="space-y-3">
                    
                    <div x-show="activeTab === 'semua' || activeTab === 'belum'" x-transition.opacity.duration.300ms class="group flex flex-col lg:flex-row items-start lg:items-center justify-between p-5 rounded-3xl hover:bg-slate-50 transition-all border border-transparent hover:border-slate-100 gap-6">
                        <div class="flex items-start gap-5">
                            <div class="w-14 h-14 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center shrink-0 font-black text-2xl shadow-inner border border-slate-200">
                                📐
                            </div>
                            <div>
                                <h4 class="text-lg font-black text-slate-800 group-hover:text-indigo-600 transition-colors mb-1">
                                    Analisis Hierarki Visual Web
                                </h4>
                                <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-sm">
                                    <p class="font-semibold text-slate-500">Mata Pelajaran: <span class="text-indigo-600">UI/UX Design</span></p>
                                    <div class="flex items-center gap-1.5 text-rose-500 font-bold bg-rose-50 px-2.5 py-1 rounded-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Tenggat: Besok, 23:59
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-row lg:flex-col items-center lg:items-end justify-between w-full lg:w-auto gap-4">
                            <span class="px-3.5 py-1.5 rounded-xl text-[11px] font-black bg-slate-100 text-slate-500 uppercase tracking-widest border border-slate-200 shadow-sm whitespace-nowrap">
                                Belum Dimulai
                            </span>
                            <a href="#" class="px-6 py-2.5 bg-indigo-50 text-indigo-700 text-sm font-bold rounded-xl hover:bg-indigo-600 hover:text-white transition-all shadow-sm active:scale-95 whitespace-nowrap text-center">
                                Mulai Kerjakan
                            </a>
                        </div>
                    </div>


                    <div x-show="activeTab === 'semua' || activeTab === 'proses'" x-transition.opacity.duration.300ms class="group flex flex-col lg:flex-row items-start lg:items-center justify-between p-5 rounded-3xl hover:bg-slate-50 transition-all border border-transparent hover:border-slate-100 gap-6 relative overflow-hidden">
                        <div class="absolute left-0 top-4 bottom-4 w-1 bg-amber-400 rounded-r-md"></div>

                        <div class="flex items-start gap-5 pl-2">
                            <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center shrink-0 font-black text-2xl shadow-inner border border-amber-100">
                                🎨
                            </div>
                            <div>
                                <h4 class="text-lg font-black text-slate-800 group-hover:text-indigo-600 transition-colors mb-1">
                                    Membuat Poster Iklan Minimalis
                                </h4>
                                <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-sm">
                                    <p class="font-semibold text-slate-500">Mata Pelajaran: <span class="text-indigo-600">Desain Grafis Dasar</span></p>
                                    <div class="flex items-center gap-1.5 text-slate-500 font-bold bg-slate-100 px-2.5 py-1 rounded-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        Tenggat: 24 Okt 2025
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-row lg:flex-col items-center lg:items-end justify-between w-full lg:w-auto gap-4">
                            <span class="px-3.5 py-1.5 rounded-xl text-[11px] font-black bg-amber-100 text-amber-700 uppercase tracking-widest border border-amber-200 shadow-sm flex items-center gap-1.5 whitespace-nowrap">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                Sedang Dikerjakan
                            </span>
                            <a href="#" class="px-6 py-2.5 bg-slate-900 text-white text-sm font-bold rounded-xl hover:bg-indigo-600 transition-all shadow-md active:scale-95 whitespace-nowrap text-center">
                                Kumpulkan Tugas
                            </a>
                        </div>
                    </div>


                    <div x-show="activeTab === 'semua' || activeTab === 'selesai'" x-transition.opacity.duration.300ms class="group flex flex-col lg:flex-row items-start lg:items-center justify-between p-5 rounded-3xl hover:bg-slate-50 transition-all border border-transparent hover:border-slate-100 gap-6 opacity-80 hover:opacity-100">
                        <div class="flex items-start gap-5">
                            <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-500 flex items-center justify-center shrink-0 font-black text-2xl shadow-inner border border-emerald-100">
                                🏆
                            </div>
                            <div>
                                <h4 class="text-lg font-black text-slate-800 group-hover:text-indigo-600 transition-colors mb-1 line-through decoration-slate-300">
                                    Ujian Teori Warna RGB & CMYK
                                </h4>
                                <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-sm">
                                    <p class="font-semibold text-slate-500">Mata Pelajaran: <span class="text-indigo-600">Fotografi Digital</span></p>
                                    <div class="flex items-center gap-1.5 text-emerald-600 font-bold bg-emerald-50 px-2.5 py-1 rounded-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Diserahkan: 12 Okt 2025
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-row lg:flex-col items-center lg:items-end justify-between w-full lg:w-auto gap-4">
                            <span class="px-3.5 py-1.5 rounded-xl text-[11px] font-black bg-emerald-100 text-emerald-700 uppercase tracking-widest border border-emerald-200 shadow-sm whitespace-nowrap">
                                Selesai (Nilai: 95)
                            </span>
                            <a href="#" class="px-6 py-2.5 bg-white border border-slate-200 text-slate-600 text-sm font-bold rounded-xl hover:bg-slate-50 hover:text-indigo-600 hover:border-indigo-200 transition-all active:scale-95 whitespace-nowrap text-center shadow-sm">
                                Lihat Detail
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</x-app-layout>