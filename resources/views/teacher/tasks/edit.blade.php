<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4 w-full bg-white">
            <a href="{{ route('teacher.tasks.show', $assignment->id) }}" class="p-2.5 bg-slate-50 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-all shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h2 class="text-xl font-bold text-slate-800">Edit Tugas</h2>
                <p class="text-sm text-slate-500 mt-0.5">Perbarui instruksi atau informasi tugas.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-[1.5rem] border border-slate-200 shadow-sm overflow-hidden">
                
                <form action="{{ route('teacher.tasks.update', $assignment->id) }}" method="POST" enctype="multipart/form-data" class="p-8">
                    @csrf
                    @method('PUT') <!-- Wajib untuk proses Update -->
                    
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Judul Tugas <span class="text-rose-500">*</span></label>
                                <input type="text" name="title" value="{{ $assignment->title }}" class="block w-full py-3 px-4 border border-slate-200 rounded-xl text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 transition-all shadow-sm" required>
                            </div>

                            <div>
                                <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Terkait Materi <span class="text-rose-500">*</span></label>
                                <select name="course_id" class="block w-full py-3 px-4 border border-slate-200 rounded-xl text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 transition-all shadow-sm appearance-none cursor-pointer" required>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}" {{ $assignment->course_id == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Batas Waktu (Deadline) <span class="text-rose-500">*</span></label>
                            <input type="datetime-local" name="deadline" value="{{ date('Y-m-d\TH:i', strtotime($assignment->deadline)) }}" class="block w-full md:w-1/2 py-3 px-4 border border-slate-200 rounded-xl text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 transition-all shadow-sm" required>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Instruksi Tugas <span class="text-rose-500">*</span></label>
                            <textarea name="description" rows="5" class="block w-full py-3 px-4 border border-slate-200 rounded-xl text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 transition-all shadow-sm" required>{{ $assignment->description }}</textarea>
                        </div>

                        <!-- Info File Lama -->
                        @if($assignment->file_path)
                        <div class="p-3 bg-blue-50 text-blue-700 text-xs rounded-lg border border-blue-100">
                            Info: File lama sudah tersimpan: {{ basename($assignment->file_path) }}. Unggah baru untuk menggantinya.
                        </div>
                        @endif

                        <div class="pt-2">
                            <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Lampiran Baru (PDF)</label>
                            <input type="file" name="file_path" accept="application/pdf" class="block w-full text-sm text-slate-500 file:mr-4 file:py-3 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-600 border border-slate-200 rounded-xl bg-slate-50 cursor-pointer shadow-sm">
                        </div>

                        <div class="pt-2">
                            <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Link Tugas / Google Form</label>
                            <input type="url" name="link_url" value="{{ $assignment->link_url }}" placeholder="https://..." class="block w-full py-3 px-4 border border-slate-200 rounded-xl text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 transition-all shadow-sm">
                        </div>

                    </div>

                    <div class="mt-10 pt-6 border-t border-slate-100 flex justify-end gap-3">
                        <a href="{{ route('teacher.tasks.show', $assignment->id) }}" class="px-6 py-3 bg-white border border-slate-200 text-slate-600 rounded-xl text-sm font-bold hover:bg-slate-50 transition shadow-sm">Batal</a>
                        <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-xl text-sm font-bold hover:bg-blue-700 transition shadow-sm flex items-center gap-2">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>