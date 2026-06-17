<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4 w-full bg-white">
            <a href="{{ route('teacher.tasks.index') }}" class="p-2.5 bg-slate-50 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-all shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h2 class="text-xl font-bold text-slate-800">Buat Tugas Baru</h2>
                <p class="text-sm text-slate-500 mt-0.5">Berikan tugas atau evaluasi baru untuk siswa di kelas.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="bg-white rounded-[1.5rem] border border-slate-200 shadow-sm overflow-hidden">
                
                <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        Detail Formulir Tugas
                    </h3>
                </div>

                <form action="{{ route('teacher.tasks.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
                    @csrf
                    
                    <div class="space-y-6">
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Judul Tugas <span class="text-rose-500">*</span></label>
                                <input type="text" name="title" class="block w-full py-3 px-4 border border-slate-200 rounded-xl text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm">
                            </div>

                           <div>
                                    <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase">Terkait Materi *</label>
                                    <input type="text" 
                                        name="course_name" 
                                        required 
                                        class="w-full bg-slate-50 border border-slate-200 text-slate-700 rounded-xl px-4 py-2.5 text-sm focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Batas Waktu (Deadline) <span class="text-rose-500">*</span></label>
                            <input type="datetime-local" name="deadline" class="block w-full md:w-1/2 py-3 px-4 border border-slate-200 rounded-xl text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm cursor-pointer" required>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Instruksi Tugas <span class="text-rose-500">*</span></label>
                            <textarea name="description" rows="5" class="block w-full py-3 px-4 border border-slate-200 rounded-xl text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm resize-y"></textarea>
                        </div>

                        <div class="pt-2">
                            <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Lampiran File (PDF) <span class="text-slate-400 font-normal ml-1 lowercase capitalize-first"></span></label>
                            <input type="file" name="file_path" accept="application/pdf" class="block w-full text-sm text-slate-500 file:mr-4 file:py-3 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100 border border-slate-200 rounded-xl bg-slate-50 cursor-pointer focus:outline-none transition-all shadow-sm">
                            <p class="text-[11px] text-slate-400 mt-2">Maksimal ukuran file 5MB.</p>
                        </div>

                        <div class="pt-2">
                            <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Link Tugas / Google Form <span class="text-slate-400 font-normal ml-1 lowercase capitalize-first"></span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                                </div>
                                <input type="url" name="link_url" placeholder="Contoh: https://docs.google.com/forms/d/e/..." class="block w-full pl-11 pr-4 py-3 border border-slate-200 rounded-xl text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm">
                            </div>
                            <p class="text-[11px] text-slate-400 mt-2"></p>
                        </div>

                    </div>

                    <div class="mt-10 pt-6 border-t border-slate-100 flex justify-end gap-3">
                        <a href="{{ route('teacher.tasks.index') }}" class="px-6 py-3 bg-white border border-slate-200 text-slate-600 rounded-xl text-sm font-bold hover:bg-slate-50 transition shadow-sm">
                            Batal
                        </a>
                        <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-xl text-sm font-bold hover:bg-blue-700 transition shadow-sm shadow-blue-200 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Simpan & Terbitkan Tugas
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>