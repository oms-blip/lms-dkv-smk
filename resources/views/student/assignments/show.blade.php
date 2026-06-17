<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4 w-full bg-white pb-2">
            <a href="{{ route('student.assignments') }}" class="p-2.5 bg-slate-50 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-all shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h2 class="text-xl font-bold text-slate-800">{{ $assignment->title }}</h2>
                <p class="text-sm text-slate-500 mt-0.5">Tugas: {{ $assignment->course->title ?? 'Umum' }}</p>
            </div>
        </div>
    </x-slot>

    @php
        // Deteksi otomatis nama kolom file di database bosku
        $pdfFile = $assignment->file_path ?? $assignment->file_tugas ?? $assignment->file_pdf ?? $assignment->materi_pdf ?? $assignment->lampiran ?? $assignment->file ?? null;
        $linkUrl = $assignment->link_url ?? $assignment->link_tugas ?? $assignment->url ?? $assignment->google_form ?? null;
    @endphp

    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm overflow-hidden flex flex-col lg:flex-row min-h-[80vh]">
                
                <div class="w-full lg:w-2/3 bg-slate-100 flex flex-col border-b lg:border-b-0 lg:border-r border-slate-200">
                    <div class="p-4 bg-white border-b border-slate-200 flex items-center justify-between">
                        <span class="text-sm font-bold text-slate-700">Lembar Tugas</span>
                        <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-[10px] font-black uppercase">
                            {{ !empty($linkUrl) ? 'Google Form' : (!empty($pdfFile) ? 'PDF' : 'Teks') }}
                        </span>
                    </div>
                    
                    <div class="flex-1 w-full h-[70vh]">
                        @if(!empty($linkUrl))
                            <iframe src="{{ $linkUrl }}" class="w-full h-full border-0"></iframe>
                        @elseif(!empty($pdfFile))
                            <iframe src="{{ Storage::url($pdfFile) }}" class="w-full h-full border-0"></iframe>
                        @else
                            <div class="flex flex-col items-center justify-center h-full text-center p-8">
                                <div class="w-16 h-16 bg-slate-200 text-slate-400 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <h3 class="text-lg font-bold text-slate-700">Tidak Ada Lampiran File</h3>
                                <p class="text-slate-500 text-sm mt-2">Silakan baca instruksi pada panel di sebelah kanan.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="w-full lg:w-1/3 flex flex-col bg-white">
                    <div class="p-8 flex-1 overflow-y-auto">
                        
                        <div class="mb-8">
                            <span class="text-[10px] font-bold text-blue-500 uppercase tracking-widest block mb-2">DESKRIPSI TUGAS</span>
                            <div class="prose prose-sm text-slate-600 whitespace-pre-line">
                                {{ $assignment->description }}
                            </div>
                        </div>

                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 mb-8">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-xs font-bold text-slate-500">Tenggat Waktu</span>
                                <span class="text-xs font-black text-rose-500">{{ \Carbon\Carbon::parse($assignment->deadline)->translatedFormat('d F Y') }}</span>
                            </div>
                        </div>

                        @if($submission)
                            <div class="text-center p-6 border-2 border-emerald-100 bg-emerald-50 rounded-2xl">
                                <div class="w-12 h-12 bg-emerald-500 text-white rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <h4 class="text-lg font-bold text-emerald-700">Tugas Terkumpul</h4>
                                @if($submission->status == 'Sudah Dinilai')
                                    <p class="text-sm text-emerald-600 mt-1 font-bold">Skor Kamu: <span class="text-xl text-emerald-800">{{ $submission->score }}/100</span></p>
                                @else
                                    <p class="text-sm text-emerald-600 mt-1">Menunggu penilaian dari guru.</p>
                                @endif
                            </div>
                        @else
                            @if(!empty($linkUrl))
                                <form action="{{ route('student.assignments.submit', $assignment->id) }}" method="POST">
                                    @csrf
                                    <div class="p-4 rounded-xl bg-blue-50 border border-blue-100 mb-6">
                                        <p class="text-xs font-bold text-blue-700">Catatan:</p>
                                        <p class="text-xs text-blue-600 mt-1">Silakan kerjakan langsung di lembar tugas. Pastikan kamu sudah login dengan email sekolah agar jawaban tersimpan dengan benar.</p>
                                    </div>
                                    
                                    <button type="submit" class="w-full py-3 bg-slate-800 text-white font-bold rounded-xl shadow-lg hover:bg-slate-900 transition flex items-center justify-center gap-2">
                                        Selesai Mengerjakan
                                    </button>
                                </form>
                            @else
                                <div class="border-t border-slate-100 pt-6">
                                    <h4 class="text-sm font-bold text-slate-800 mb-4">Pengumpulan Jawaban</h4>
                                    <form action="{{ route('student.assignments.submit', $assignment->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        
                                        @if($errors->any())
                                            <div class="mb-4 p-3 bg-rose-50 border border-rose-200 rounded-xl text-xs font-bold text-rose-600">
                                                Silakan upload file jawaban ATAU tempel link Canva/Drive kamu. Tidak boleh kosong!
                                            </div>
                                        @endif

                                        <div class="mb-4">
                                            <label class="block text-xs font-bold text-slate-500 mb-2">Upload File</label>
                                            <input type="file" name="file_path" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border border-slate-200 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                                        </div>
                                        <div class="mb-6">
                                            <label class="block text-xs font-bold text-slate-500 mb-2">Link</label>
                                            <input type="url" name="link_url" placeholder="https://..." class="block w-full px-4 py-2 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                                        </div>
                                        <button type="submit" class="w-full py-3 bg-blue-600 text-white font-bold rounded-xl shadow-md hover:bg-blue-700 transition">
                                            Kirim Tugas
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>