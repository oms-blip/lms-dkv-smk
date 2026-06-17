<aside class="fixed inset-y-0 left-0 w-[260px] bg-[#0f172a] border-r border-slate-800 flex flex-col z-50">
    
    <div class="p-6 pb-4 flex items-center space-x-3">
        <div class="w-10 h-10 rounded-[12px] bg-blue-500 flex items-center justify-center shadow-[0_0_20px_rgba(59,130,246,0.3)] shrink-0">
            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c1.38 0 2.5-1.12 2.5-2.5 0-.61-.23-1.17-.61-1.61-.41-.48-.68-1.09-.68-1.78 0-1.38 1.12-2.5 2.5-2.5H18c2.76 0 5-2.24 5-5 0-4.42-4.93-8-11-8zm-4 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3-4c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm4 0c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3 4c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"/>
            </svg>
        </div>
        <div>
            <h1 class="text-white font-bold text-[18px] tracking-wide leading-tight">DKV Learn</h1>
            <p class="text-blue-400 text-[10px] font-bold tracking-[0.15em] uppercase mt-0.5">Panel Guru</p>
        </div>
    </div>

    <div class="px-5 mb-5 mt-2">
        <a href="#" class="flex items-center justify-center space-x-2 w-full bg-slate-800/40 border border-slate-700/60 hover:bg-slate-700/50 hover:border-slate-600 text-blue-200 text-sm font-medium py-2.5 rounded-xl transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
            <span>Beralih ke Mode Siswa</span>
        </a>
    </div>

    <div class="flex-1 overflow-y-auto px-4 space-y-1 custom-scrollbar">
        
        <p class="text-slate-500 text-[11px] font-bold uppercase tracking-widest px-3 mt-4 mb-3">Menu Utama</p>
        
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl group transition-all {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/60' }}">
            <svg class="w-5 h-5 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            <span class="text-sm font-semibold tracking-wide">Dashboard</span>
        </a>
        
        <a href="{{ route('courses.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl group transition-all {{ request()->routeIs('courses.*') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/60' }}">
            <svg class="w-5 h-5 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            <span class="text-sm font-medium tracking-wide">Kelola Materi</span>
        </a>
        
        <a href="{{ route('teacher.tasks.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl group transition-all {{ request()->routeIs('teacher.tasks.index') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/60' }}">
            <svg class="w-5 h-5 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
            <span class="text-sm font-medium tracking-wide">Kelola Tugas</span>
        </a>

        <p class="text-slate-500 text-[11px] font-bold uppercase tracking-widest px-3 mt-6 mb-3">Monitoring</p>
        
        <a href="{{ route('teacher.students.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl group transition-all {{ request()->routeIs('teacher.students.index') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/60' }}">
            <svg class="w-5 h-5 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            <span class="text-sm font-medium tracking-wide">Data Siswa</span>
        </a>
        
        <a href="{{ route('teacher.reports.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl group transition-all {{ request()->routeIs('teacher.reports.index') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/60' }}">
            <svg class="w-5 h-5 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            <span class="text-sm font-medium tracking-wide">Laporan & Nilai (TES SAKTI)</span>
        </a>
        
        <p class="text-slate-500 text-[11px] font-bold uppercase tracking-widest px-3 mt-6 mb-3">Lainnya</p>
        
        <a href="#" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl group transition-all text-slate-400 hover:text-slate-200 hover:bg-slate-800/60">
            <svg class="w-5 h-5 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            <span class="text-sm font-medium tracking-wide">Pengaturan</span>
        </a>
    </div>

   <div class="p-4 border-t border-slate-800/60 mt-auto bg-[#0f172a]">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center w-full space-x-3 px-3 py-2.5 rounded-xl text-slate-400 hover:text-red-400 hover:bg-red-900/10 transition-all group">
                <svg class="w-5 h-5 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                <span class="text-sm font-semibold tracking-wide">Keluar</span>
            </button>
        </form>
    </div>
</aside>