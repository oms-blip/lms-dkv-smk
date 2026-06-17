<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4 w-full bg-white pb-2">
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 shadow-inner">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Profil Saya</h2>
                <p class="text-sm text-slate-500 mt-0.5">Kelola informasi profil dan lihat pencapaian kamu.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm overflow-hidden">
                        <div class="h-32 bg-gradient-to-br from-blue-500 to-blue-700 relative"></div>
                        
                        <div class="px-6 pb-6 relative text-center flex flex-col items-center">
                            <div class="w-24 h-24 bg-white rounded-3xl p-1.5 shadow-lg absolute -top-12 border border-slate-100 relative group">
                                <div class="w-full h-full bg-slate-100 rounded-2xl flex items-center justify-center text-4xl font-black text-slate-400">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <button class="absolute -bottom-2 -right-2 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center shadow-md border-2 border-white hover:bg-blue-700 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path></svg>
                                </button>
                            </div>
                            
                            <h3 class="mt-4 text-2xl font-black text-slate-800">{{ $user->name }}</h3>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-1">
                                {{ $user->class ?? 'Kelas X DKV' }} • {{ $user->school ?? 'SMKN Kebonagung' }}
                            </p>

                            <div class="w-full grid grid-cols-3 gap-3 mt-8 border-t border-slate-100 pt-6">
                                <div>
                                    <h4 class="text-2xl font-black text-blue-600">{{ $progress }}%</h4>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Progress</p>
                                </div>
                                <div class="border-x border-slate-100">
                                    <h4 class="text-2xl font-black text-emerald-500">{{ round($rataRata) }}</h4>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Rata-Rata</p>
                                </div>
                                <div>
                                    <h4 class="text-2xl font-black text-amber-500">{{ $totalTugas }}</h4>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Tugas</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2 space-y-6">
                    
                    <div class="bg-white p-8 rounded-[2rem] border border-slate-200 shadow-sm">
                        <div class="flex items-center justify-between mb-8 border-b border-slate-100 pb-4">
                            <h3 class="text-lg font-bold text-slate-800">Informasi Pribadi</h3>
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-600 rounded-xl text-sm font-bold hover:bg-blue-600 hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                Edit Profil
                            </a>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex items-start gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-100">
                                <div class="w-12 h-12 bg-white text-blue-500 rounded-xl flex items-center justify-center shrink-0 shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Nama Lengkap</p>
                                    <p class="text-sm font-bold text-slate-800">{{ $user->name }}</p>
                                </div>
                            </div>
                            
                            <div class="bg-slate-50 rounded-2xl p-4 flex items-center space-x-4 border border-slate-100">
                                <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center shrink-0">
                                    <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                
                                <div>
                                    <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-wider mb-0.5">Kelas</p>
                                    <p class="text-sm font-bold text-slate-800">
                                        {{ Auth::user()->kelas ?? 'Belum dipilih' }}
                                    </p>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-100">
                                <div class="w-12 h-12 bg-white text-blue-500 rounded-xl flex items-center justify-center shrink-0 shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Email</p>
                                    <p class="text-sm font-bold text-slate-800">{{ $user->email }}</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-100">
                                <div class="w-12 h-12 bg-white text-emerald-500 rounded-xl flex items-center justify-center shrink-0 shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Telepon</p>
                                    <p class="text-sm font-bold text-slate-800">{{ $user->phone ?? 'Belum diatur' }}</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-100">
                                <div class="w-12 h-12 bg-white text-amber-500 rounded-xl flex items-center justify-center shrink-0 shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Alamat</p>
                                    <p class="text-sm font-bold text-slate-800 line-clamp-2">{{ $user->address ?? 'Belum diatur' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-[2rem] border border-slate-200 shadow-sm">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-slate-800">Pencapaian (Achievements)</h3>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="text-center p-4 rounded-2xl border {{ $progress > 50 ? 'border-amber-200 bg-amber-50' : 'border-slate-100 bg-slate-50 opacity-60' }} transition-all">
                                <div class="w-12 h-12 mx-auto rounded-full {{ $progress > 50 ? 'bg-amber-100 text-amber-500' : 'bg-slate-200 text-slate-400' }} flex items-center justify-center mb-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                                <h4 class="text-[11px] font-black {{ $progress > 50 ? 'text-amber-700' : 'text-slate-500' }} uppercase tracking-wider mb-1">Fast Learner</h4>
                                <p class="text-[9px] text-slate-500 leading-tight">Selesaikan lebih dari 50% materi</p>
                            </div>

                            <div class="text-center p-4 rounded-2xl border {{ $rataRata >= 90 ? 'border-blue-200 bg-blue-50' : 'border-slate-100 bg-slate-50 opacity-60' }} transition-all">
                                <div class="w-12 h-12 mx-auto rounded-full {{ $rataRata >= 90 ? 'bg-blue-100 text-blue-500' : 'bg-slate-200 text-slate-400' }} flex items-center justify-center mb-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <h4 class="text-[11px] font-black {{ $rataRata >= 90 ? 'text-blue-700' : 'text-slate-500' }} uppercase tracking-wider mb-1">Nilai Sempurna</h4>
                                <p class="text-[9px] text-slate-500 leading-tight">Rata-rata nilai di atas 90</p>
                            </div>

                            <div class="text-center p-4 rounded-2xl border {{ $totalTugas > 3 ? 'border-rose-200 bg-rose-50' : 'border-slate-100 bg-slate-50 opacity-60' }} transition-all">
                                <div class="w-12 h-12 mx-auto rounded-full {{ $totalTugas > 3 ? 'bg-rose-100 text-rose-500' : 'bg-slate-200 text-slate-400' }} flex items-center justify-center mb-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path></svg>
                                </div>
                                <h4 class="text-[11px] font-black {{ $totalTugas > 3 ? 'text-rose-700' : 'text-slate-500' }} uppercase tracking-wider mb-1">Rajin Kumpul</h4>
                                <p class="text-[9px] text-slate-500 leading-tight">Kumpul lebih dari 3 tugas</p>
                            </div>

                            <div class="text-center p-4 rounded-2xl border border-slate-100 bg-slate-50 opacity-60 transition-all">
                                <div class="w-12 h-12 mx-auto rounded-full bg-slate-200 text-slate-400 flex items-center justify-center mb-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                </div>
                                <h4 class="text-[11px] font-black text-slate-500 uppercase tracking-wider mb-1">Bookworm</h4>
                                <p class="text-[9px] text-slate-500 leading-tight">Membaca lebih dari 10 materi</p>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>