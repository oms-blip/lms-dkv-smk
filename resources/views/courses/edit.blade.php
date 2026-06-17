<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-slate-800">Edit Modul</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4">
            <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm">
                
                <form action="{{ route('courses.update', $course->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Judul Modul</label>
                            <input type="text" name="title" value="{{ $course->title }}" class="w-full border border-slate-200 rounded-xl p-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none" required>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Link Thumbnail Kelas (Opsional)</label>
                            <input type="text" name="thumbnail" value="{{ $course->thumbnail }}" placeholder="Paste link gambar dari Google Drive / Canva..." class="w-full border border-slate-200 rounded-xl p-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Deskripsi</label>
                            <textarea name="description" rows="4" class="w-full border border-slate-200 rounded-xl p-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none" required>{{ $course->description }}</textarea>
                        </div>

                        <div class="p-6 bg-slate-50 border border-slate-200 rounded-2xl space-y-5">
                            <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider border-b pb-2">Materi Tambahan Modul</h3>
                            
                            <div>
                                <label for="materi_pdf" class="text-xs font-bold text-slate-500 uppercase tracking-widest block mb-2">Link File Modul (PDF / GDrive)</label>
                                
                                @if($course->materi_pdf)
                                    <div class="mb-3 flex items-center gap-2 p-3 bg-blue-50 border border-blue-100 rounded-xl text-xs text-blue-700 font-medium overflow-hidden">
                                        <svg class="w-4 h-4 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                                        <span class="truncate">Link saat ini: <a href="{{ Str::startsWith($course->materi_pdf, 'http') ? $course->materi_pdf : '#' }}" target="_blank" class="underline font-bold hover:text-blue-900">Buka Link Materi</a></span>
                                    </div>
                                @endif

                                <input id="materi_pdf" name="materi_pdf" type="text" value="{{ old('materi_pdf', $course->materi_pdf) }}" class="block w-full text-sm text-slate-700 border border-slate-200 rounded-xl bg-white p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Paste link Google Drive baru di sini..." />
                                <p class="text-[11px] text-slate-400 mt-1.5">Gunakan link Google Drive untuk menghindari server penuh.</p>
                                @error('materi_pdf') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="video_link" class="text-xs font-bold text-slate-500 uppercase tracking-widest block mb-2">Link Video</label>
                                <input id="video_link" name="video_link" type="url" class="w-full border border-slate-200 rounded-xl p-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none" 
                                       value="{{ old('video_link', $course->video_link) }}" placeholder="Contoh: https://www.youtube.com/watch?v=xxxxxx" />
                                <p class="text-[11px] text-slate-400 mt-1.5">YouTube</p>
                                @error('video_link') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="flex gap-4 pt-4">
                            <a href="{{ route('courses.index') }}" class="px-6 py-2.5 bg-slate-100 text-slate-600 rounded-xl text-sm font-bold hover:bg-slate-200 transition">Batal</a>
                            <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-bold hover:bg-blue-700 transition">Simpan Perubahan</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>