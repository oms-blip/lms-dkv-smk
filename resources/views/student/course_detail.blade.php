<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Kelas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <div class="flex flex-col md:flex-row gap-8">
                    <div class="w-full md:w-1/3">
                        @if($course->thumbnail)
                            <img src="{{ asset('storage/' . $course->thumbnail) }}" class="w-full rounded-xl shadow-md">
                        @else
                            <div class="w-full h-48 bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-400 font-bold">DKV</div>
                        @endif
                    </div>

                    <div class="w-full md:w-2/3">
                        <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ $course->title }}</h3>
                        <p class="text-indigo-600 font-medium mb-4 italic">Bersama: {{ $course->teacher->name }}</p>
                        
                        <div class="prose prose-indigo mb-8 text-gray-600">
                            <h4 class="text-lg font-semibold text-gray-800">Deskripsi & Tujuan:</h4>
                            <p>{{ $course->description }}</p>
                        </div>

                        @if($isEnrolled)
                            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                Kamu sudah terdaftar di kelas ini.
                            </div>
                            <a href="{{ route('student.classroom', $course->slug) }}" class="inline-flex items-center justify-center w-full px-6 py-3 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition">
                                Masuk ke Ruang Kelas
                            </a>
                        @else
                            <form action="{{ route('katalog.enroll', $course->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="inline-flex items-center justify-center w-full px-6 py-3 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition">
                                    Daftar Sekarang
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>