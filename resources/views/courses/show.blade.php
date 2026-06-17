<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Materi: ') . $course->title }}
            </h2>
            <a href="{{ route('dashboard') }}" style="color: #4f46e5; font-weight: bold;">← Kembali ke Dashboard</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           
            @if ($errors->any())
    <div style="background-color: #fee2e2; color: #dc2626; padding: 15px; margin-bottom: 20px; border-radius: 8px; font-weight: bold;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>⚠️ {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('success'))
                <div class="mb-6 p-4" style="background-color: #d1fae5; color: #065f46; border-left: 4px solid #10b981; font-weight: bold; border-radius: 4px;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-8 border border-gray-100">
                <div class="flex justify-between items-center mb-8 border-b pb-4">
                    <h3 class="text-xl font-extrabold text-gray-800">Struktur Kurikulum / Modul</h3>
                    
                    <!-- TOMBOL TAMBAH MODUL (WARNA UNGU PAKSA) -->
                    <button type="button" onclick="document.getElementById('modal-module').classList.remove('hidden')" 
                        style="background-color: #4f46e5; color: white; padding: 10px 20px; border-radius: 8px; font-weight: bold; border: none; cursor: pointer; text-transform: uppercase; font-size: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                        + Tambah Modul Baru
                    </button>
                </div>

                <div class="space-y-8">
                    @forelse($course->modules as $module)
                        <div class="border-2 rounded-2xl overflow-hidden border-gray-100 shadow-sm">
                            <div class="p-5 flex justify-between items-center border-b" style="background-color: #f9fafb;">
                                <h4 style="font-weight: 900; color: #1f2937; text-transform: uppercase;">{{ $module->title }}</h4>
                                
                                <form action="{{ route('modules.destroy', $module) }}" method="POST" onsubmit="return confirm('Hapus modul?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" style="background-color: #fee2e2; color: #dc2626; padding: 5px 12px; border-radius: 6px; font-weight: bold; font-size: 10px; border: 1px solid #fecaca; cursor: pointer;">
                                        HAPUS MODUL
                                    </button>
                                </form>
                            </div>

                            <div class="p-6 bg-white">
                                <table class="w-full text-sm text-left mb-6">
                                    <thead>
                                        <tr style="color: #9ca3af; text-transform: uppercase; font-size: 10px; border-bottom: 1px solid #f3f4f6;">
                                            <th class="py-3 px-2">Daftar Materi (Lesson)</th>
                                            <th class="py-3 px-2 text-right">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-50">
                                        @forelse($module->lessons as $lesson)
                                            <tr>
                                                <td class="py-4 px-2" style="font-weight: 600; color: #374151;">
                                                    {{ $lesson->title }}
                                                    @if($lesson->video_url) 
                                                        <span style="background-color: #dc2626; color: white; padding: 2px 6px; border-radius: 4px; font-size: 9px; font-weight: 900; margin-left: 8px;">VIDEO</span> 
                                                    @endif
                                                </td>
                                                <td class="py-4 px-2 text-right">
                                                    <form action="{{ route('lessons.destroy', $lesson) }}" method="POST" class="inline">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" style="color: #dc2626; font-weight: bold; border: none; background: none; cursor: pointer; text-decoration: underline;">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="2" class="py-6 text-center text-gray-400 italic">Belum ada materi.</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                <!-- TOMBOL TAMBAH MATERI (WARNA INDIGO MUDA PAKSA) -->
                                <button type="button" onclick="openLessonModal('{{ $module->id }}')" 
                                    style="width: 100%; padding: 12px; border: 2px dashed #c7d2fe; background-color: #f5f3ff; color: #4f46e5; border-radius: 12px; font-weight: 800; cursor: pointer; text-transform: uppercase; font-size: 11px;">
                                    + Tambah Materi Baru (Lesson)
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-20 border-2 border-dashed border-gray-200 rounded-3xl bg-gray-50">
                            <p class="text-gray-500 font-bold">Belum ada modul yang tersedia.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL MODUL -->
    <div id="modal-module" class="fixed inset-0 hidden flex items-center justify-center p-4 z-[100]" style="background-color: rgba(0,0,0,0.6); backdrop-filter: blur(4px);">
        <div class="bg-white rounded-2xl max-w-md w-full p-8 shadow-2xl">
            <h3 style="font-weight: 900; font-size: 20px; margin-bottom: 20px; text-transform: uppercase;">Tambah Modul</h3>
            <form action="{{ route('modules.store', $course->id) }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label style="display: block; font-size: 10px; font-weight: 900; color: #6b7280; text-transform: uppercase; margin-bottom: 8px;">Judul Modul</label>
                    <input type="text" name="title" required style="width: 100%; border: 1px solid #d1d5db; border-radius: 8px; padding: 12px;">
                </div>
                <button type="submit" style="width: 100%; background-color: #4f46e5; color: white; padding: 15px; border-radius: 10px; font-weight: bold; border: none; cursor: pointer; margin-bottom: 10px;">SIMPAN MODUL</button>
                <button type="button" onclick="document.getElementById('modal-module').classList.add('hidden')" style="width: 100%; background-color: #f3f4f6; color: #4b5563; padding: 10px; border-radius: 10px; font-weight: bold; border: none; cursor: pointer;">BATAL</button>
            </form>
        </div>
    </div>

    <!-- MODAL LESSON -->
    <div id="modal-lesson" class="fixed inset-0 hidden flex items-center justify-center p-4 z-[100]" style="background-color: rgba(0,0,0,0.6); backdrop-filter: blur(4px);">
        <div class="bg-white rounded-2xl max-w-2xl w-full p-8 shadow-2xl">
            <h3 style="font-weight: 900; font-size: 20px; color: #4f46e5; margin-bottom: 20px; text-transform: uppercase;">Tambah Materi Baru</h3>
            <form id="form-lesson" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label style="display: block; font-size: 10px; font-weight: 900; color: #6b7280; text-transform: uppercase; margin-bottom: 4px;">Judul Materi</label>
                        <input type="text" name="title" required style="width: 100%; border: 1px solid #d1d5db; border-radius: 8px; padding: 12px;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 10px; font-weight: 900; color: #6b7280; text-transform: uppercase; margin-bottom: 4px;">Link Video YouTube</label>
                        <input type="url" name="video_url" style="width: 100%; border: 1px solid #d1d5db; border-radius: 8px; padding: 12px;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 10px; font-weight: 900; color: #6b7280; text-transform: uppercase; margin-bottom: 4px;">Isi Materi / Instruksi</label>
                        <textarea name="content" rows="6" required style="width: 100%; border: 1px solid #d1d5db; border-radius: 8px; padding: 12px;"></textarea>
                    </div>
                </div>
                <button type="submit" style="width: 100%; background-color: #4f46e5; color: white; padding: 15px; border-radius: 10px; font-weight: bold; border: none; cursor: pointer; margin-top: 20px;">SIMPAN MATERI</button>
                <button type="button" onclick="closeLessonModal()" style="width: 100%; background-color: #f3f4f6; color: #4b5563; padding: 10px; border-radius: 10px; font-weight: bold; border: none; cursor: pointer; margin-top: 10px;">BATAL</button>
            </form>
        </div>
    </div>

    <script>
        function openLessonModal(moduleId) {
            document.getElementById('form-lesson').action = `/modules/${moduleId}/lessons`;
            document.getElementById('modal-lesson').classList.remove('hidden');
        }
        function closeLessonModal() {
            document.getElementById('modal-lesson').classList.add('hidden');
        }
    </script>
</x-app-layout>