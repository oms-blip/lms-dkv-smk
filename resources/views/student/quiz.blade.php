<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Evaluasi Akhir: ') . $course->title }}
            </h2>
            <a href="{{ route('student.classroom', $course->slug) }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-800">
                ← Kembali ke Ruang Kelas
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @php
                // Cek apakah siswa sudah pernah mengerjakan kuis ini
                $lastAttempt = $quiz->attempts()->where('user_id', Auth::id())->latest()->first();
            @endphp

            @if($lastAttempt)
                <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-100 p-10 text-center">
                    <div class="mb-6">
                        <div class="inline-flex items-center justify-center w-24 h-24 bg-emerald-100 text-emerald-600 rounded-full mb-4">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-3xl font-black text-gray-900 uppercase tracking-tighter">Hasil Evaluasi Anda</h3>
                        <p class="text-gray-500 mt-2">Selamat! Anda telah menyelesaikan seluruh rangkaian pembelajaran.</p>
                    </div>

                    <div class="bg-slate-50 rounded-3xl p-8 mb-8 border border-slate-100">
                        <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Skor Terakhir</span>
                        <div class="text-7xl font-black text-indigo-600 mt-2">
                            {{ $lastAttempt->score }}<span class="text-2xl text-slate-400">/100</span>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('student.classroom', $course->slug) }}" 
                           class="px-8 py-4 bg-indigo-600 text-white rounded-xl font-black uppercase tracking-widest hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition">
                            Kembali ke Materi
                        </a>
                        </div>
                </div>

            @else
                <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-100">
                    <div class="p-8 border-b border-gray-50 bg-slate-50/50">
                        <h3 class="text-lg font-black text-gray-800 uppercase">Instruksi Pengerjaan</h3>
                        <ul class="text-sm text-gray-600 mt-2 list-disc list-inside space-y-1">
                            <li>Baca pertanyaan dengan teliti sebelum memilih jawaban.</li>
                            <li>Anda hanya dapat mengirimkan jawaban satu kali.</li>
                            <li>Pastikan semua soal telah terjawab sebelum menekan tombol kumpulkan.</li>
                        </ul>
                    </div>

                    <form action="{{ route('quiz.submit', $course->slug) }}" method="POST" class="p-8">
                        @csrf
                        <div class="space-y-12">
                            @foreach($quiz->questions as $index => $question)
                                <div class="relative">
                                    <span class="absolute -left-4 top-0 text-4xl font-black text-slate-100 -z-10">
                                        {{ sprintf('%02d', $index + 1) }}
                                    </span>
                                    
                                    <p class="text-lg font-bold text-gray-800 mb-6 leading-relaxed">
                                        {{ $question->question_text }}
                                    </p>

                                    <div class="grid grid-cols-1 gap-3">
                                        @foreach(['a', 'b', 'c', 'd'] as $option)
                                            @php $optName = "option_" . $option; @endphp
                                            <label class="group flex items-center p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-indigo-500 hover:bg-indigo-50/30 transition-all">
                                                <input type="radio" 
                                                       name="answers[{{ $question->id }}]" 
                                                       value="{{ $option }}" 
                                                       required
                                                       class="w-5 h-5 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                                <span class="ml-4 text-gray-700 font-semibold group-hover:text-indigo-700">
                                                    <span class="uppercase font-black mr-2">{{ $option }}.</span> 
                                                    {{ $question->$optName }}
                                                </span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-16 pt-8 border-t border-gray-100">
                            <button type="submit" 
                                    onclick="return confirm('Apakah Anda yakin ingin mengumpulkan jawaban sekarang?')"
                                    class="w-full py-5 bg-indigo-600 text-white rounded-2xl font-black uppercase tracking-widest text-lg hover:bg-indigo-700 shadow-xl shadow-indigo-200 transition-all transform active:scale-95">
                                Kumpulkan Jawaban Sekarang
                            </button>
                            <p class="text-center text-gray-400 text-xs mt-4 font-bold uppercase tracking-tighter">
                                Periksa kembali jawaban Anda sebelum mengirim
                            </p>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>