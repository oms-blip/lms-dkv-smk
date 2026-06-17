<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-[26px] font-extrabold text-slate-800 leading-tight tracking-tight">Kelola Jadwal</h2>
                <p class="text-sm text-slate-500 font-medium mt-1">Atur jadwal kelas dan tatap muka siswa.</p>
            </div>
            <a href="/dashboard" class="px-4 py-2 bg-slate-100 text-slate-600 rounded-xl text-sm font-bold hover:bg-slate-200 transition-colors">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="p-8 max-w-7xl mx-auto">
        
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-600 rounded-2xl text-sm font-bold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-[24px] border border-slate-100 shadow-sm sticky top-8">
                    <h3 class="text-lg font-extrabold text-slate-800 mb-4 border-b border-slate-100 pb-3">Tambah Jadwal Baru</h3>
                    
                    <form action="{{ route('teacher.schedules.store') }}" method="POST" class="space-y-4">
                        @csrf
                        
                        <div>
                            <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase">Hari</label>

                            @php
                                $hariInggris = \Carbon\Carbon::now()->timezone('Asia/Jakarta')->format('l');
                                $namaHari = ['Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'];
                                $hariIni = $namaHari[$hariInggris];
                            @endphp

                            <select name="day" required class="w-full bg-slate-50 border border-slate-200 text-slate-700 rounded-xl px-4 py-2.5 text-sm focus:ring-blue-500 focus:border-blue-500 outline-none">
                                <option value="Senin" {{ $hariIni == 'Senin' ? 'selected' : '' }}>Senin</option>
                                <option value="Selasa" {{ $hariIni == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                <option value="Rabu" {{ $hariIni == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                <option value="Kamis" {{ $hariIni == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                <option value="Jumat" {{ $hariIni == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                <option value="Sabtu" {{ $hariIni == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase">Mulai</label>
                                <input type="time" name="start_time" required class="w-full bg-slate-50 border border-slate-200 text-slate-700 rounded-xl px-4 py-2.5 text-sm focus:ring-blue-500 outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase">Selesai</label>
                                <input type="time" name="end_time" class="w-full bg-slate-50 border border-slate-200 text-slate-700 rounded-xl px-4 py-2.5 text-sm focus:ring-blue-500 outline-none">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase">Pelajaran</label>
                            <input type="text" name="title" required placeholder="Cth: Tipografi Lanjutan" class="w-full bg-slate-50 border border-slate-200 text-slate-700 rounded-xl px-4 py-2.5 text-sm focus:ring-blue-500 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase">Ruangan</label>
                            <input type="text" name="room" class="w-full bg-slate-50 border border-slate-200 text-slate-700 rounded-xl px-4 py-2.5 text-sm focus:ring-blue-500 outline-none">
                        </div>

                        <button type="submit" class="w-full mt-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition-colors shadow-lg shadow-blue-600/20 text-sm">
                            Simpan Jadwal
                        </button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-6">
                @forelse($schedules as $day => $dailySchedules)
                    <div class="bg-white p-6 rounded-[24px] border border-slate-100 shadow-sm">
                        <div class="flex items-center gap-2 mb-4 border-b border-slate-100 pb-3">
                            <div class="w-8 h-8 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold">
                                {{ substr($day, 0, 1) }}
                            </div>
                            <h3 class="text-lg font-black text-slate-800 uppercase tracking-wider">{{ $day }}</h3>
                        </div>

                        <div class="space-y-3">
                            @foreach($dailySchedules as $schedule)
                                <div class="group flex items-center justify-between p-4 rounded-2xl bg-slate-50 hover:bg-blue-50/50 border border-slate-100 hover:border-blue-100 transition-all">
                                    <div class="flex items-center gap-4">
                                        <div class="text-center bg-white px-3 py-2 rounded-xl shadow-sm border border-slate-100 min-w-[80px]">
                                            <span class="text-sm font-black text-blue-600 block">{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}</span>
                                            <span class="text-[10px] font-bold text-slate-400 block border-t border-slate-100 mt-1 pt-1">{{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') ?? 'Selesai' }}</span>
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-extrabold text-slate-800">{{ $schedule->title }}</h4>
                                            <p class="text-[11px] font-medium text-slate-500 mt-0.5">📍 {{ $schedule->room }}</p>
                                        </div>
                                    </div>
                                    
                                    <form action="{{ route('teacher.schedules.destroy', $schedule->id) }}" method="POST" onsubmit="return confirm('Hapus jadwal ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="opacity-0 group-hover:opacity-100 p-2 text-rose-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="bg-white p-12 rounded-[24px] border border-slate-200 border-dashed text-center">
                        <div class="w-16 h-16 bg-slate-50 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="text-base font-bold text-slate-700 mb-1">Jadwal Kosong</h3>
                        <p class="text-xs text-slate-400">Belum ada jadwal kelas yang ditambahkan. Silakan gunakan form di sebelah kiri.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>