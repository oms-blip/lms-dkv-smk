<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4 w-full bg-white pb-2">
            <a href="{{ route('teacher.tasks.grade', $assignment->id) }}" class="p-2.5 bg-slate-50 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-all shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h2 class="text-xl font-bold text-slate-800">Lembar Penilaian: {{ $submission->student->name ?? 'Siswa' }}</h2>
                <p class="text-sm text-slate-500 mt-0.5">Tugas: {{ $assignment->title }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <div class="lg:col-span-2 flex flex-col h-[80vh] bg-white rounded-[1.5rem] border border-slate-200 shadow-sm overflow-hidden">
                    <div class="p-4 border-b border-slate-100 bg-slate-50">
                        <span class="text-sm font-bold text-slate-700">Lampiran Tugas Siswa</span>
                    </div>
                    <div class="flex-1 bg-slate-200 w-full h-full relative">
                        @if($submission->file_path)
                            <iframe src="{{ Storage::url($submission->file_path) }}" class="w-full h-full border-0"></iframe>
                        @elseif($submission->link_url)
                            <div class="flex flex-col items-center justify-center h-full text-slate-500 bg-white">
                                <p class="mb-4">Siswa melampirkan tautan eksternal (Google Drive/Canva/dll):</p>
                                <a href="{{ $submission->link_url }}" target="_blank" class="px-6 py-3 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 transition">Buka Tautan Tugas</a>
                            </div>
                        @else
                            <div class="flex flex-col items-center justify-center h-full text-slate-500 bg-white">
                                <p>Siswa tidak melampirkan file atau tautan apapun.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-white rounded-[1.5rem] border border-slate-200 shadow-sm p-6 sticky top-6">
                        
                        <div class="mb-6 pb-6 border-b border-slate-100 flex justify-between items-center">
                            <h3 class="text-lg font-bold text-slate-800">Beri Nilai</h3>
                            @if($submission->status == 'Sudah Dinilai')
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-bold uppercase rounded-md">Sudah Dinilai</span>
                            @else
                                <span class="px-3 py-1 bg-amber-50 text-amber-600 text-[10px] font-bold uppercase rounded-md">Menunggu</span>
                            @endif
                        </div>

                        <form action="{{ route('teacher.tasks.saveGrade', $submission->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-6">
                                <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Skor Nilai (0 - 100) <span class="text-rose-500">*</span></label>
                                <input type="number" name="score" min="0" max="100" value="{{ $submission->score }}" class="block w-full text-3xl font-black text-center py-4 border border-slate-200 rounded-xl bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 text-blue-600 transition-all" placeholder="0" required>
                            </div>

                            <div class="mb-8">
                                <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Catatan / Evaluasi</label>
                                <textarea name="feedback" rows="4" class="block w-full py-3 px-4 border border-slate-200 rounded-xl text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 transition-all resize-y" placeholder="Berikan evaluasi terhadap karya desain ini...">{{ $submission->feedback }}</textarea>
                            </div>

                            <button type="submit" class="w-full py-3 bg-blue-600 text-white rounded-xl text-sm font-bold hover:bg-blue-700 transition shadow-sm shadow-blue-200">
                                Simpan Nilai ke Database
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>