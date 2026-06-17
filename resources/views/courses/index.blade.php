<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div>
                <h2 class="text-[26px] font-extrabold text-slate-800 leading-tight tracking-tight">Kelola Materi</h2>
                <p class="text-sm text-slate-500 flex items-center mt-1 font-medium">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                </p>
            </div>
            
            <div class="flex items-center space-x-4">
                
                <div class="relative" x-data="{ open: false }">
                    @php
                        // VARIABEL PENENTU JUMLAH NOTIFIKASI
                        // Ubah angka 0 di bawah ini menjadi 5 atau berapapun untuk melihat perubahan otomatisnya!
                        $jumlahNotif = 0; 
                    @endphp

                    <button @click="open = !open" @click.away="open = false" class="relative text-slate-400 hover:text-blue-600 transition-colors p-2 rounded-full hover:bg-slate-100 outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        
                        @if($jumlahNotif > 0)
                            <span class="absolute top-1 right-1 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-[9px] font-bold text-white border-2 border-white">
                                {{ $jumlahNotif }}
                            </span>
                        @endif
                    </button>

                    <div x-show="open" x-transition class="absolute right-0 mt-2 w-80 bg-white rounded-2xl border border-slate-200 shadow-xl z-50 py-2 text-sm text-slate-600" style="display: none;">
                        <div class="px-4 py-2 font-bold text-slate-800 border-b border-slate-100 flex justify-between items-center">
                            Notifikasi
                            @if($jumlahNotif > 0)
                                <span class="text-[9px] bg-red-100 text-red-600 px-2 py-0.5 rounded-full uppercase tracking-wider">{{ $jumlahNotif }} Baru</span>
                            @endif
                        </div>
                        
                        @if($jumlahNotif > 0)
                            <div class="p-4 text-center text-slate-500 text-xs">
                                Anda memiliki <b>{{ $jumlahNotif }}</b> pemberitahuan yang belum dibaca.
                            </div>
                        @else
                            <div class="p-4 text-center text-slate-400 text-xs flex flex-col items-center">
                                <svg class="w-8 h-8 text-slate-200 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                Belum ada notifikasi baru.
                            </div>
                        @endif
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

    <div class="p-8 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto space-y-6">

            <div class="flex flex-col md:flex-row justify-between items-stretch md:items-center gap-4 mb-8">
                <div class="relative flex-1 max-w-2xl">
                    <input type="text" id="search-course" class="w-full pl-12 pr-4 py-3.5 bg-white border border-slate-200 rounded-[16px] focus:ring-blue-500 focus:border-blue-500 shadow-sm text-sm outline-none" placeholder="Cari modul pembelajaran...">
                    <svg class="absolute left-4 top-4 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>

                <a href="{{ route('courses.create') }}" class="bg-blue-600 text-white px-6 py-3.5 rounded-[16px] font-bold text-sm hover:bg-blue-700 shadow-md shadow-blue-600/20 flex items-center justify-center transition-all shrink-0">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Buat Modul Baru
                </a>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 pb-10">
                
                @forelse($courses ?? [] as $course)
                    <div class="course-card bg-white rounded-[24px] border border-slate-100 overflow-hidden shadow-sm hover:shadow-md transition-shadow flex h-[200px] group">
                        
                        <div class="w-[40%] relative bg-gradient-to-br from-indigo-500 to-purple-600 shrink-0">
                            <div class="absolute top-4 left-4">
                                <span class="bg-emerald-500 text-white text-[10px] font-black uppercase tracking-wider px-2.5 py-1 rounded-full shadow-sm flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Published
                                </span>
                            </div>
                        </div>

                        <div class="w-[60%] p-5 sm:p-6 flex flex-col justify-between">
                            <div>
                                <p class="text-[10px] font-black text-blue-500 uppercase tracking-widest mb-1">{{ $course->category ?? 'DKV UMUM' }}</p>
                                <h3 class="course-title text-lg sm:text-xl font-extrabold text-slate-800 leading-tight line-clamp-1 group-hover:text-blue-600 transition-colors">{{ $course->title }}</h3>
                                
                                <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-[11px] text-slate-500 mt-3 font-semibold">
                                    <span class="flex items-center"><svg class="w-3.5 h-3.5 mr-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg> 8 Materi</span>
                                    <span class="flex items-center"><svg class="w-3.5 h-3.5 mr-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg> 90 Siswa</span>
                                    <span class="flex items-center"><svg class="w-3.5 h-3.5 mr-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> {{ $course->created_at ? $course->created_at->format('d M Y') : 'Baru saja' }}</span>
                                </div>
                            </div>
                            
                            <div class="flex gap-2.5 mt-4">
                                <a href="{{ route('courses.edit', $course->id) }}" class="px-4 py-2 bg-blue-50 text-blue-600 rounded-xl text-xs font-bold hover:bg-blue-100 border border-blue-100 flex items-center transition-colors">
                                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg> Edit
                                </a>
                                
                                <a href="{{ route('student.classroom', $course->slug) }}" target="_blank" class="px-4 py-2 bg-slate-50 text-slate-600 rounded-xl text-xs font-bold hover:bg-slate-100 border border-slate-200 flex items-center transition-colors">
                                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg> Preview
                                </a>

                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="ml-auto" onsubmit="return confirm('Yakin ingin menghapus materi ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-300 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 lg:col-span-2 text-center py-16 bg-white rounded-[24px] border border-slate-100 border-dashed">
                        <div class="w-16 h-16 bg-blue-50 text-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-1">Belum Ada Materi</h3>
                        <p class="text-sm text-slate-500 mb-6">Klik tombol 'Buat Modul Baru' untuk mulai mengajar.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('#search-course');
            const courseCards = document.querySelectorAll('.course-card');

            function filterCourses() {
                const keyword = searchInput.value.toLowerCase();
                courseCards.forEach(card => {
                    const titleElement = card.querySelector('.course-title');
                    if (titleElement) {
                        const titleText = titleElement.textContent.toLowerCase();
                        card.style.setProperty('display', titleText.includes(keyword) ? 'flex' : 'none', 'important');
                    }
                });
            }

            if (searchInput) {
                searchInput.addEventListener('keyup', filterCourses);
                searchInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        filterCourses();
                    }
                });
            }
        });
    </script>
</x-app-layout>