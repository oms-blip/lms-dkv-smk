<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4 w-full bg-white pb-2">
            <a href="{{ route('student.katalog') }}" class="p-2.5 bg-slate-50 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h2 class="text-xl font-bold text-slate-800">{{ $course->title }}</h2>
                <p class="text-sm text-slate-500 mt-0.5">Lanjutkan materi belajarmu di sini.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 xl:grid-cols-12 gap-8">
                
                <div class="xl:col-span-8 space-y-6">
                    
                    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-200 overflow-hidden">
                        
                        @php
                            // Ambil link video langsung dari tabel Course
                            $youtubeUrl = $course->video_link ?? null;
                            $embedUrl = null;
                            if($youtubeUrl) {
                                if(str_contains($youtubeUrl, 'watch?v=')) {
                                    $embedUrl = str_replace('watch?v=', 'embed/', $youtubeUrl);
                                    $embedUrl = explode('&', $embedUrl)[0]; 
                                } elseif(str_contains($youtubeUrl, 'youtu.be/')) {
                                    $embedUrl = str_replace('youtu.be/', 'www.youtube.com/embed/', $youtubeUrl);
                                } else {
                                    $embedUrl = $youtubeUrl;
                                }
                            }
                        @endphp

                        @if($embedUrl)
                            <div class="w-full bg-slate-900 aspect-video relative">
                                <iframe src="{{ $embedUrl }}" class="absolute top-0 left-0 w-full h-full border-0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-indigo-600 to-purple-700 flex items-center justify-center p-8">
                                <h2 class="text-3xl font-black text-white text-center">{{ $course->title }}</h2>
                            </div>
                        @endif

                        <div class="p-6 sm:p-8">
                            <span class="text-[10px] font-bold text-indigo-500 uppercase tracking-widest mb-2 block">MATERI UTAMA KELAS</span>
                            <h1 class="text-2xl sm:text-3xl font-black text-slate-800 mb-4">{{ $course->title }}</h1>
                            
                            <div class="prose prose-slate max-w-none text-slate-600 mb-8 whitespace-pre-line leading-relaxed">
                                {{ $course->description }}
                            </div>

                            @if(!empty($course->materi_pdf))
                                <div class="mt-8 border-t border-slate-100 pt-8">
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="w-10 h-10 bg-rose-50 text-rose-500 rounded-xl flex items-center justify-center shadow-inner">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 6H7a2 2 0 00-2 2v11a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <h3 class="text-lg font-bold text-slate-800">Modul Tambahan</h3>
                                    </div>
                                    
                                    <div class="w-full p-6 bg-slate-50 border border-slate-200 rounded-2xl flex flex-col sm:flex-row items-center justify-between gap-4">
                                        <div>
                                            <p class="font-bold text-slate-700">Materi Referensi Eksternal</p>
                                            <p class="text-sm text-slate-500">Klik tombol di samping untuk membuka atau mengunduh materi dari Google Drive.</p>
                                        </div>
                                        
                                        <a href="{{ Str::startsWith($course->materi_pdf, 'http') ? $course->materi_pdf : '#' }}" 
                                           target="_blank" 
                                           class="shrink-0 px-6 py-3 bg-white border border-slate-300 text-slate-700 font-bold rounded-xl shadow-sm hover:bg-slate-100 transition-all flex items-center gap-2">
                                            <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                            Buka Materi
                                        </a>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="mt-10 pt-6 border-t border-slate-100 flex justify-end">
                                <a href="{{ route('student.katalog') }}" class="px-6 py-3 bg-emerald-500 text-white font-bold rounded-xl shadow-lg shadow-emerald-200 hover:bg-emerald-600 transition-all flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Selesai
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>