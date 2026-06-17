<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DKV Learn') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-slate-900 bg-slate-50 overflow-hidden">
    
    <div x-data="{ sidebarOpen: false }" class="flex h-screen w-full relative">

        <div x-show="sidebarOpen" 
             @click="sidebarOpen = false"
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-30 md:hidden">
        </div>

        @if(Auth::user()->role === 'teacher' || Auth::user()->role === 'admin')
            
            <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
                   class="absolute md:relative w-[260px] bg-[#0f172a] border-r border-slate-800 flex flex-col flex-shrink-0 h-full z-40 transform transition-transform duration-300 ease-in-out md:translate-x-0">
                <div class="p-6 pb-4 flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-[12px] bg-blue-500 flex items-center justify-center shadow-[0_0_20px_rgba(59,130,246,0.3)] shrink-0">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c1.38 0 2.5-1.12 2.5-2.5 0-.61-.23-1.17-.61-1.61-.41-.48-.68-1.09-.68-1.78 0-1.38 1.12-2.5 2.5-2.5H18c2.76 0 5-2.24 5-5 0-4.42-4.93-8-11-8zm-4 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3-4c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm4 0c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3 4c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"/></svg>
                    </div>
                    <div>
                        <h1 class="text-white font-bold text-[18px] tracking-wide leading-tight">DKV Learn</h1>
                        <p class="text-blue-400 text-[10px] font-bold tracking-[0.15em] uppercase mt-0.5">Panel Guru</p>
                    </div>
                </div>

                <div class="px-5 mb-5 mt-2">
                    <a href="#" class="flex items-center justify-center space-x-2 w-full bg-slate-800/40 border border-slate-700/60 hover:bg-slate-700/50 hover:border-slate-600 text-blue-200 text-sm font-medium py-2.5 rounded-xl transition-all shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                        <span>Beralih ke Mode Siswa</span>
                    </a>
                </div>

                <div class="flex-1 overflow-y-auto px-4 space-y-1">
                    <p class="text-slate-500 text-[11px] font-bold uppercase tracking-[0.2em] px-3 mt-4 mb-3">Menu Utama</p>

                    <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2.5 rounded-xl group transition-all relative {{ request()->is('dashboard') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/20' : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/60' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->is('dashboard') ? 'opacity-90' : 'group-hover:text-slate-300 transition-colors' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        <span class="text-sm {{ request()->is('dashboard') ? 'font-semibold' : 'font-medium' }} tracking-wide flex-1">Dashboard</span>
                        @if(request()->is('dashboard')) <span class="w-1.5 h-1.5 bg-white rounded-full ml-auto"></span> @endif
                    </a>

                    <a href="{{ route('courses.index') }}" class="flex items-center px-3 py-2.5 rounded-xl group transition-all relative mt-1 {{ request()->routeIs('courses.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/20' : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/60' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('courses.*') ? 'opacity-90' : 'group-hover:text-slate-300 transition-colors' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        <span class="text-sm {{ request()->routeIs('courses.*') ? 'font-semibold' : 'font-medium' }} tracking-wide flex-1">Kelola Materi</span>
                        @if(request()->routeIs('courses.*')) <span class="w-1.5 h-1.5 bg-white rounded-full ml-auto"></span> @endif
                    </a>

                    <a href="{{ route('teacher.tasks.index') }}" class="flex items-center px-3 py-2.5 rounded-xl group transition-all relative mt-1 {{ request()->routeIs('teacher.tasks.index') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/20' : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/60' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('teacher.tasks.index') ? 'opacity-90' : 'group-hover:text-slate-300 transition-colors' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        <span class="text-sm {{ request()->routeIs('teacher.tasks.index') ? 'font-semibold' : 'font-medium' }} tracking-wide flex-1">Kelola Tugas</span>
                        @if(request()->routeIs('teacher.tasks.index')) <span class="w-1.5 h-1.5 bg-white rounded-full ml-auto"></span> @endif
                    </a>

                    <p class="text-slate-500 text-[11px] font-bold uppercase tracking-[0.2em] px-3 mt-7 mb-3">Monitoring</p>
                    
                    <a href="{{ route('teacher.students.index') }}" class="flex items-center px-3 py-2.5 rounded-xl group transition-all relative mt-1 {{ request()->routeIs('teacher.students.index') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/20' : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/60' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('teacher.students.index') ? 'opacity-90' : 'group-hover:text-slate-300 transition-colors' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <span class="text-sm {{ request()->routeIs('teacher.students.index') ? 'font-semibold' : 'font-medium' }} tracking-wide flex-1">Data Siswa</span>
                        @if(request()->routeIs('teacher.students.index')) <span class="w-1.5 h-1.5 bg-white rounded-full ml-auto"></span> @endif
                    </a>

                    <a href="{{ route('teacher.reports.index') }}" class="flex items-center px-3 py-2.5 rounded-xl group transition-all relative mt-1 {{ request()->routeIs('teacher.reports.index') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/20' : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/60' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('teacher.reports.index') ? 'opacity-90' : 'group-hover:text-slate-300 transition-colors' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        <span class="text-sm {{ request()->routeIs('teacher.reports.index') ? 'font-semibold' : 'font-medium' }} tracking-wide flex-1">Laporan & Nilai</span>
                        @if(request()->routeIs('teacher.reports.index')) <span class="w-1.5 h-1.5 bg-white rounded-full ml-auto"></span> @endif
                    </a>

                    <p class="text-slate-500 text-[11px] font-bold uppercase tracking-[0.2em] px-3 mt-7 mb-3">Lainnya</p>
                    
                    <a href="{{ route('teacher.settings.index') }}" class="flex items-center px-3 py-2.5 rounded-xl group transition-all relative mt-1 {{ request()->routeIs('teacher.settings.index') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/20' : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/60' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('teacher.settings.index') ? 'opacity-90' : 'group-hover:text-slate-300 transition-colors' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span class="text-sm {{ request()->routeIs('teacher.settings.index') ? 'font-semibold' : 'font-medium' }} tracking-wide flex-1">Pengaturan</span>
                        @if(request()->routeIs('teacher.settings.index')) <span class="w-1.5 h-1.5 bg-white rounded-full ml-auto"></span> @endif
                    </a>
                </div>

                <div class="p-4 border-t border-slate-800/60 mt-auto bg-[#0f172a]">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center space-x-3 text-slate-400 hover:text-red-400 px-3 py-2.5 rounded-xl w-full transition-all group">
                            <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            <span class="text-sm font-medium tracking-wide">Keluar</span>
                        </button>
                    </form>
                </div>
            </aside>

       @else
            <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
                   class="absolute md:relative w-[260px] bg-[#1e3a8a] border-r border-blue-800 flex flex-col flex-shrink-0 h-full z-40 transform transition-transform duration-300 ease-in-out md:translate-x-0">
                <div class="h-full px-5 py-8 flex flex-col justify-between overflow-y-auto custom-scrollbar">
                    <div>
                        <div class="flex items-center gap-3 mb-10 px-2">
                            <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center shadow-lg shrink-0">
                                <svg class="w-6 h-6 text-blue-900" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c1.38 0 2.5-1.12 2.5-2.5 0-.61-.23-1.17-.61-1.61-.41-.48-.68-1.09-.68-1.78 0-1.38 1.12-2.5 2.5-2.5H18c2.76 0 5-2.24 5-5 0-4.42-4.93-8-11-8zm-4 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3-4c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm4 0c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3 4c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"/></svg>
                            </div>
                            <div>
                                <h1 class="text-[18px] font-black text-white tracking-wide leading-tight">DKV Learn</h1>
                                <p class="text-blue-300 text-[10px] font-bold tracking-[0.15em] uppercase mt-0.5">Platform Belajar</p>
                            </div>
                        </div>

                        <nav class="space-y-1.5">
                            <p class="px-3 text-[10px] font-bold text-blue-300/70 uppercase tracking-[0.2em] mb-3 mt-4">Menu Utama</p>

                            <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2.5 rounded-xl group transition-all relative {{ request()->is('dashboard') ? 'bg-blue-600 text-white shadow-md' : 'text-blue-100 hover:bg-blue-800/50 hover:text-white' }}">
                                <svg class="w-5 h-5 mr-3 {{ request()->is('dashboard') ? 'opacity-100' : 'opacity-70 group-hover:opacity-100' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                                <span class="text-sm font-medium tracking-wide flex-1">Beranda</span>
                                @if(request()->is('dashboard')) <span class="w-1.5 h-1.5 bg-white rounded-full ml-auto"></span> @endif
                            </a>

                            <a href="{{ route('student.katalog') }}" class="flex items-center px-3 py-2.5 rounded-xl group transition-all relative {{ request()->routeIs('student.katalog') ? 'bg-blue-600 text-white shadow-md' : 'text-blue-100 hover:bg-blue-800/50 hover:text-white' }}">
                                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('student.katalog') ? 'opacity-100' : 'opacity-70 group-hover:opacity-100' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                <span class="text-sm font-medium tracking-wide flex-1">Materi</span>
                                @if(request()->routeIs('student.katalog')) <span class="w-1.5 h-1.5 bg-white rounded-full ml-auto"></span> @endif
                            </a>

                            <a href="{{ route('student.assignments') }}" class="flex items-center px-3 py-2.5 rounded-xl group transition-all relative {{ request()->routeIs('student.assignments') ? 'bg-blue-600 text-white shadow-md' : 'text-blue-100 hover:bg-blue-800/50 hover:text-white' }}">
                                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('student.assignments') ? 'opacity-100' : 'opacity-70 group-hover:opacity-100' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                <span class="text-sm font-medium tracking-wide flex-1">Tugas</span>
                                @if(request()->routeIs('student.assignments')) <span class="w-1.5 h-1.5 bg-white rounded-full ml-auto"></span> @endif
                            </a>

                            <a href="{{ route('student.profile') }}" class="flex items-center px-3 py-2.5 rounded-xl group transition-all relative {{ request()->routeIs('student.profile') ? 'bg-blue-600 text-white shadow-md' : 'text-blue-100 hover:bg-blue-800/50 hover:text-white' }}">
                                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('student.profile') ? 'opacity-100' : 'opacity-70 group-hover:opacity-100' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                <span class="text-sm font-medium tracking-wide flex-1">Profil</span>
                                @if(request()->routeIs('student.profile')) <span class="w-1.5 h-1.5 bg-white rounded-full ml-auto"></span> @endif
                            </a>
                        </nav>
                    </div>

                    <div class="mt-8 border-t border-blue-800/50 pt-4">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center px-3 py-2.5 rounded-xl text-sm font-medium text-blue-200 hover:text-red-400 hover:bg-blue-800/50 transition-all group">
                                <svg class="w-5 h-5 mr-3 opacity-70 group-hover:opacity-100 group-hover:-translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </aside>
        @endif

        <div class="flex-1 flex flex-col h-screen overflow-hidden bg-slate-50 relative w-full">
            
            <div class="md:hidden bg-white border-b border-slate-200 px-4 py-3 flex items-center shadow-sm z-10">
                <button @click="sidebarOpen = true" class="text-slate-500 hover:text-slate-800 focus:outline-none p-1 mr-3 rounded-lg hover:bg-slate-100 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <span class="font-bold text-slate-800 text-lg">DKV Learn</span>
            </div>

            @if (isset($header))
                <header class="bg-white border-b border-slate-200 z-10 flex-shrink-0">
                    <div class="px-8 py-4">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <main class="flex-1 overflow-y-auto">
                {{ $slot }}
            </main>
            
        </div>

    </div>
</body>
</html>