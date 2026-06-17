<x-app-layout>
    <!-- ========================================== -->
    <!-- HEADER -->
    <!-- ========================================== -->
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center w-full bg-white pb-2">
            <div class="flex items-center gap-4 mb-4 sm:mb-0">
                <h2 class="text-xl font-bold text-slate-800 tracking-tight mt-1">Pengaturan</h2>
                <div class="flex items-center gap-2 px-3 py-1.5 bg-slate-50 border border-slate-100 rounded-lg text-slate-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span class="text-xs font-semibold">Senin, 18 Mei 2026</span>
                </div>
            </div>
            
            <div class="flex items-center gap-4 md:gap-6 w-full sm:w-auto justify-end">
                <button onclick="alert('Tidak ada notifikasi baru.')" class="relative text-slate-400 hover:text-blue-600 transition-colors focus:outline-none shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                </button>
                <div class="h-8 w-px bg-slate-200 hidden sm:block shrink-0"></div>
                
                <!-- Profil Dropdown (Aktif) -->
                <div class="relative shrink-0" x-data="{ openProfile: false }">
                    <button @click="openProfile = !openProfile" @click.away="openProfile = false" class="flex items-center gap-3 focus:outline-none text-left group">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-bold text-slate-800 leading-tight group-hover:text-blue-600 transition">{{ Auth::user()->name ?? 'Ibu Ratna Dewi' }}</p>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">GURU DKV</p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-blue-50 border border-blue-100 text-blue-600 flex items-center justify-center text-sm font-bold shadow-sm group-hover:ring-2 group-hover:ring-blue-200 transition-all">RD</div>
                    </button>
                    <div x-show="openProfile" x-transition class="absolute right-0 mt-3 w-48 bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden z-50" style="display: none;">
                        <div class="p-2">
                            <a href="#" class="flex items-center gap-2 px-3 py-2 text-sm font-semibold text-slate-700 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition">Pengaturan</a>
                            <form method="POST" action="{{ route('logout') }}">@csrf <button type="submit" class="flex items-center gap-2 px-3 py-2 text-sm font-semibold text-rose-600 hover:bg-rose-50 rounded-xl transition w-full text-left">Keluar</button></form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <!-- ========================================== -->
    <!-- KONTEN UTAMA (x-data="activeTab" untuk Tab)-->
    <!-- ========================================== -->
    <div class="py-8 bg-slate-50 min-h-screen" x-data="{ activeTab: 'profil' }">
        <div class="max-w-[60rem] mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            <!-- Judul Halaman -->
            <div class="flex items-center gap-4 mb-6">
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 shadow-sm border border-blue-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Pengaturan</h2>
                    <p class="text-sm text-slate-500 mt-0.5">Kelola profil, keamanan, dan preferensi aplikasi.</p>
                </div>
            </div>

            <div class="bg-white rounded-[1.5rem] shadow-sm border border-slate-200 overflow-hidden">
                <!-- ========================================== -->
                <!-- TAB NAVIGATION -->
                <!-- ========================================== -->
                <div class="flex items-center gap-8 px-6 border-b border-slate-100 overflow-x-auto scrollbar-hide">
                    <!-- Tab Profil -->
                    <button @click="activeTab = 'profil'" :class="activeTab === 'profil' ? 'border-blue-600 text-blue-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300'" class="flex items-center gap-2 py-4 border-b-2 font-bold text-sm transition whitespace-nowrap">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Profil
                    </button>
                    <!-- Tab Keamanan -->
                    <button @click="activeTab = 'keamanan'" :class="activeTab === 'keamanan' ? 'border-blue-600 text-blue-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300'" class="flex items-center gap-2 py-4 border-b-2 font-bold text-sm transition whitespace-nowrap">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        Keamanan
                    </button>
                    <!-- Tab Notifikasi -->
                    <button @click="activeTab = 'notifikasi'" :class="activeTab === 'notifikasi' ? 'border-blue-600 text-blue-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300'" class="flex items-center gap-2 py-4 border-b-2 font-bold text-sm transition whitespace-nowrap">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        Notifikasi
                    </button>
                    <!-- Tab Tampilan -->
                    <button @click="activeTab = 'tampilan'" :class="activeTab === 'tampilan' ? 'border-blue-600 text-blue-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300'" class="flex items-center gap-2 py-4 border-b-2 font-bold text-sm transition whitespace-nowrap">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        Tampilan
                    </button>
                </div>

                <!-- ========================================== -->
                <!-- ISI TAB: PROFIL -->
                <!-- ========================================== -->
                <div x-show="activeTab === 'profil'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="p-6 sm:p-8">
                    
                    <!-- Kartu Profil Atas -->
                    <div class="flex items-center gap-5 mb-8 pb-8 border-b border-slate-100">
                        <div class="w-16 h-16 rounded-full bg-blue-50 border border-blue-100 text-blue-600 font-bold text-xl flex items-center justify-center shadow-sm">
                            RD
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-800">Ibu Ratna Dewi, S.Pd</h3>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">GURU DKV</p>
                            <p class="text-xs text-slate-500 font-medium mt-0.5">NIP: 198705142010012003</p>
                        </div>
                    </div>

                    <!-- Form Pengaturan Profil -->
                    <form onsubmit="event.preventDefault(); alert('Perubahan profil berhasil disimpan ke database!');">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Nama Lengkap</label>
                                <input type="text" value="Ratna Dewi, S.Pd" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-700 focus:bg-white focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all shadow-sm">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">NIP</label>
                                <input type="text" value="198705142010012003" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-700 focus:bg-white focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all shadow-sm">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Email</label>
                                <input type="email" value="ratna.dewi@smk1kreatif.sch.id" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-700 focus:bg-white focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all shadow-sm">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Telepon</label>
                                <input type="text" value="+62 821 5678 1234" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-700 focus:bg-white focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all shadow-sm">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Mata Pelajaran</label>
                                <input type="text" value="Desain Komunikasi Visual" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-700 focus:bg-white focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all shadow-sm">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Sekolah</label>
                                <input type="text" value="SMK Negeri 1 Kreatif" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-700 focus:bg-white focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all shadow-sm">
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex flex-col sm:flex-row items-center justify-end gap-3 pt-6 border-t border-slate-100">
                            <button type="button" onclick="alert('Aksi dibatalkan, form dikembalikan seperti semula.')" class="w-full sm:w-auto px-6 py-3 text-sm font-bold text-slate-500 hover:text-slate-800 hover:bg-slate-100 rounded-xl transition">
                                Batal
                            </button>
                            <button type="submit" class="w-full sm:w-auto flex items-center justify-center gap-2 px-6 py-3 bg-blue-600 text-white rounded-xl text-sm font-bold hover:bg-blue-700 transition shadow-sm shadow-blue-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

                <!-- ========================================== -->
                <!-- ISI TAB: KEAMANAN (Contoh Tab Lain)        -->
                <!-- ========================================== -->
                <div x-show="activeTab === 'keamanan'" style="display: none;" class="p-6 sm:p-8 text-center py-16">
                    <div class="w-16 h-16 bg-slate-50 text-slate-300 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-1">Keamanan Akun</h3>
                    <p class="text-sm text-slate-500">Form ubah kata sandi dan autentikasi 2 langkah akan tampil di sini.</p>
                </div>

                <!-- ========================================== -->
                <!-- ISI TAB: NOTIFIKASI                        -->
                <!-- ========================================== -->
                <div x-show="activeTab === 'notifikasi'" style="display: none;" class="p-6 sm:p-8 text-center py-16">
                    <div class="w-16 h-16 bg-slate-50 text-slate-300 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-1">Preferensi Notifikasi</h3>
                    <p class="text-sm text-slate-500">Atur pemberitahuan email dan sistem di sini.</p>
                </div>

                <!-- ========================================== -->
                <!-- ISI TAB: TAMPILAN                          -->
                <!-- ========================================== -->
                <div x-show="activeTab === 'tampilan'" style="display: none;" class="p-6 sm:p-8 text-center py-16">
                    <div class="w-16 h-16 bg-slate-50 text-slate-300 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-1">Pengaturan Tampilan</h3>
                    <p class="text-sm text-slate-500">Ubah tema (Dark/Light mode) akan tersedia di pembaruan selanjutnya.</p>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>