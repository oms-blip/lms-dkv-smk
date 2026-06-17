<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Laporan Progres Siswa: ') . $course->title }}
            </h2>
            <a href="{{ route('courses.index') }}" class="text-sm text-indigo-600 hover:underline">← Kembali</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-bold">Rekapitulasi Kelas X DKV</h3>
                        <p class="text-sm text-gray-500">Total Materi: {{ $totalLessons }} Lesson</p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-200">
                                    <th class="px-6 py-4 text-xs font-medium text-gray-500 uppercase">Nama Siswa</th>
                                    <th class="px-6 py-4 text-xs font-medium text-gray-500 uppercase">Tanggal Bergabung</th>
                                    <th class="px-6 py-4 text-xs font-medium text-gray-500 uppercase">Progres Belajar</th>
                                    <th class="px-6 py-4 text-xs font-medium text-gray-500 uppercase text-center">Persentase</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($course->enrolledStudents as $student)
                                    @php
                                        // Hitung materi yang diselesaikan siswa HANYA untuk course ini
                                        $completedInThisCourse = $student->completedLessons
                                            ->whereIn('id', $courseLessonIds)
                                            ->count();
                                        
                                        $percentage = $totalLessons > 0 
                                            ? round(($completedInThisCourse / $totalLessons) * 100) 
                                            : 0;
                                    @endphp
                                    <tr>
                                        <td class="px-6 py-4 text-sm font-bold text-gray-900">{{ $student->name }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $student->pivot->created_at->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 w-1/3">
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-indigo-600 h-2.5 rounded-full transition-all duration-500" 
                                                     style="width: {{ $percentage }}%"></div>
                                            </div>
                                            <p class="text-[10px] mt-1 text-gray-400 italic">
                                                {{ $completedInThisCourse }} dari {{ $totalLessons }} materi selesai
                                            </p>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="px-2 py-1 {{ $percentage == 100 ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }} rounded text-xs font-bold">
                                                {{ $percentage }}%
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-10 text-center text-gray-400 italic">
                                            Belum ada siswa yang mendaftar di kelas ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>