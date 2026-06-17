<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 w-full bg-white pb-2">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 shadow-inner">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-slate-800 tracking-tight"> Materi</h2>
                    <p class="text-sm text-slate-500 mt-0.5"></p>
                </div>
            </div>
            
            <div class="relative w-full md:w-80">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input oninput="window.dispatchEvent(new CustomEvent('update-search', {detail: this.value}))" type="text" class="block w-full pl-11 pr-4 py-2.5 border border-slate-200 rounded-full text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-slate-900 placeholder-slate-400 shadow-sm" placeholder="Cari materi, kategori...">
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen" x-data="{ filter: 'semua', search: '' }" @update-search.window="search = $event.detail">
        <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

           @if($courses && $courses->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($courses as $course)
                        @php
                            $kategori = $course->category ?? 'Desain Grafis';
                        @endphp
                        
                        <div x-show="(filter === 'semua' || filter === '{{ $kategori }}') && ({{ json_encode(strtolower($course->title)) }}.includes(search.toLowerCase()) || {{ json_encode(strtolower($kategori)) }}.includes(search.toLowerCase()))" 
                             style="display: none;"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform scale-95"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             class="bg-white rounded-[2rem] p-5 shadow-sm border border-slate-100 flex flex-col group hover:shadow-xl hover:shadow-indigo-100/50 transition-all duration-300">
                            
                            <div class="h-48 bg-slate-100 rounded-2xl relative overflow-hidden mb-5">
                                @if($course->thumbnail)
                                    <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-indigo-800 to-slate-900 flex items-center justify-center p-6 text-white font-black text-2xl italic group-hover:scale-105 transition-transform duration-700">
                                        DKV
                                    </div>
                                @endif
                                
                                <!-- LABEL "DESAIN GRAFIS" SUDAH JAMAL HAPUS DARI SINI BOSKU -->

                            </div>
                            
                            <h4 class="text-lg font-black text-slate-900 leading-tight mb-3 group-hover:text-indigo-600 transition-colors line-clamp-2">{{ $course->title }}</h4>
                            
                            <div class="flex items-center gap-2 mb-5 mt-auto">
                                <div class="w-6 h-6 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-xs font-bold shrink-0">
                                    {{ strtoupper(substr($course->teacher->name ?? 'G', 0, 1)) }}
                                </div>
                                <p class="text-xs font-medium text-slate-500">{{ $course->teacher->name ?? 'Instruktur' }}</p>
                            </div>

                            <div class="pt-4 border-t border-slate-50 mt-auto">
                                <a href="{{ route('student.classroom', $course->slug ?? $course->id) }}" class="flex items-center justify-center w-full py-3 bg-indigo-50 text-indigo-700 rounded-xl text-sm font-bold hover:bg-indigo-600 hover:text-white transition-colors group/btn gap-2">
                                    Lihat Materi
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else                <div class="flex flex-col items-center justify-center py-24 bg-white rounded-[2rem] border border-slate-100 shadow-sm text-center px-4">
                    <div class="w-32 h-32 mb-6 bg-slate-50 rounded-full flex items-center justify-center">
                        <svg class="w-16 h-16 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-800 mb-2">Belum Ada Materi</h3>
                    <p class="text-slate-500 max-w-md mx-auto mb-8">Guru belum membuat materi apapun saat ini. Silakan kembali lagi nanti!</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>