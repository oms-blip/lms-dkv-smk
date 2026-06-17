<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-slate-800">Buat Tugas Baru</h2>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4">
            <div class="bg-white rounded-[1.5rem] border border-slate-200 p-8 shadow-sm">
                
                <form action="{{ route('teacher.tasks.store') }}" method="POST">
                    @csrf
                    
                    <div class="space-y-6">
                        
                        <div>
                            <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase">Pilih Materi Kelas *</label>
                            <select name="course_id" required class="w-full bg-slate-50 border border-slate-200 text-slate-700 rounded-xl px-4 py-3 text-sm focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Judul Tugas *</label>
                            <input type="text" name="title" required class="block w-full py-3 px-4 border border-slate-200 rounded-xl text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 transition-all">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Batas Waktu (Deadline) *</label>
                            <input type="datetime-local" name="deadline" required class="block w-full py-3 px-4 border border-slate-200 rounded-xl text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 transition-all">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Instruksi Tugas *</label>
                            <textarea name="description" required rows="5" class="block w-full py-3 px-4 border border-slate-200 rounded-xl text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 transition-all"></textarea>
                        </div>

                        <div class="pt-2">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Link Lampiran (Google Drive)</label>
                            <input type="text" name="file_path" placeholder="Paste link Google Drive di sini..." class="block w-full py-3 px-4 border border-slate-200 rounded-xl text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 transition-all">
                            <p class="text-[11px] text-slate-400 mt-2">Masukkan link file PDF dari Google Drive.</p>
                        </div>

                        <div class="pt-2">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Link Google Form / Tugas</label>
                            <input type="url" name="link_url" placeholder="https://..." class="block w-full py-3 px-4 border border-slate-200 rounded-xl text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 transition-all">
                        </div>

                    </div>

                    <div class="mt-10 pt-6 border-t border-slate-100 flex justify-end gap-3">
                        <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-xl text-sm font-bold hover:bg-blue-700 transition shadow-sm">
                            Simpan & Terbitkan Tugas
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>