<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Modul DKV Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="title" :value="__('Judul Kelas')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')"  />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="slug" :value="__('Slug (URL Otomatis)')" />
                            <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full bg-gray-50" :value="old('slug')"  />
                            <p class="text-xs text-gray-500 mt-1"></p>
                        </div>

                        <div>
                            <x-input-label for="thumbnail" :value="__('Thumbnail Kelas')" />
                            <input id="thumbnail" name="thumbnail" type="file" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" accept="image/*" />
                            <p class="text-xs text-gray-500 mt-1">JPG, PNG, atau JPEG (Maks. 2MB).</p>
                            <x-input-error class="mt-2" :messages="$errors->get('thumbnail')" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Deskripsi & Tujuan Pembelajaran')" />
                            <textarea id="description" name="description" rows="6" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" ">{{ old('description') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="p-5 bg-gray-50 border border-gray-200 rounded-lg space-y-5">
                            <h3 class="text-sm font-bold text-gray-700 border-b pb-2">Materi Pembelajaran</h3>
                            
                            <div>
                                <x-input-label for="materi_pdf" :value="__('File Modul ')" />
                                <input id="materi_pdf" name="materi_pdf" type="file" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none" accept=".pdf" />
                                <p class="text-xs text-gray-500 mt-1">Format: PDF (Maks. 5MB)</p>
                                <x-input-error class="mt-2" :messages="$errors->get('materi_pdf')" />
                            </div>

                            <div>
                                <x-input-label for="video_link" :value="__('Link Video')" />
                                <x-text-input id="video_link" name="video_link" type="url" class="mt-1 block w-full" :value="old('video_link')" />
                                <p class="text-xs text-gray-500 mt-1">YouTube.</p>
                                <x-input-error class="mt-2" :messages="$errors->get('video_link')" />
                            </div>
                        </div>
                        <div class="flex items-center justify-end gap-4 border-t pt-6">
                            <a href="{{ route('courses.index') }}" class="text-sm text-gray-600 hover:underline">Batal</a>
                            <x-primary-button>
                                {{ __('Simpan Kelas') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('keyup', function() {
            let preslug = title.value;
            preslug = preslug.replace(/[^a-zA-Z0-9 ]/g, "");
            preslug = preslug.replace(/\s+/g, "-");
            slug.value = preslug.toLowerCase();
        });
    </script>
</x-app-layout>