<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LMS Vokasi - Platform Belajar Digital</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: { sans: ['Figtree', 'sans-serif'] },
                        colors: {
                            brand: {
                                50: '#eff6ff',
                                100: '#dbeafe',
                                500: '#3b82f6',
                                600: '#2563eb',
                                900: '#1e3a8a',
                            }
                        }
                    }
                }
            }
        </script>
    @endif
</head>
<body class="font-sans antialiased bg-slate-50 text-slate-900 selection:bg-indigo-500 selection:text-white flex flex-col min-h-screen">

    <header class="fixed w-full top-0 z-50 bg-slate-900/90 backdrop-blur-md border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex-shrink-0 flex items-center gap-2">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-teal-400 flex items-center justify-center shadow-lg shadow-indigo-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <span class="text-2xl font-extrabold tracking-tight text-white">LMS <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-teal-400">Vokasi</span></span>
                </div>

                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-slate-300 hover:text-white transition-colors duration-200">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-300 hover:text-white transition-colors duration-200 hidden sm:block">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-bold text-white bg-indigo-600 rounded-lg hover:bg-indigo-500 focus:ring-4 focus:ring-indigo-500/50 transition-all duration-300 shadow-lg shadow-indigo-600/30">
                                    Register
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow pt-20">
        <section class="relative bg-slate-900 overflow-hidden min-h-[90vh] flex items-center">
            <div class="absolute top-0 left-1/2 w-full -translate-x-1/2 h-full overflow-hidden pointer-events-none">
                <div class="absolute -top-[20%] -right-[10%] w-[700px] h-[700px] rounded-full bg-indigo-600/20 blur-[120px]"></div>
                <div class="absolute -bottom-[20%] -left-[10%] w-[600px] h-[600px] rounded-full bg-teal-500/20 blur-[120px]"></div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 py-16 lg:py-0">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    
                    <div class="text-center lg:text-left">
                        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-800/50 border border-slate-700 backdrop-blur-sm mb-6">
                            <span class="flex h-2 w-2 rounded-full bg-teal-400"></span>
                            <span class="text-xs font-semibold tracking-wide text-slate-300 uppercase">Khusus untuk Siswa Multimedia & DKV</span>
                        </div>
                        
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white leading-tight mb-6 tracking-tight">
                            Platform Belajar <br class="hidden lg:block">
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 via-teal-400 to-indigo-400 bg-300% animate-gradient">Digital Interaktif</span>
                        </h1>
                        
                        <p class="text-lg sm:text-xl text-slate-400 mb-10 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                            Tingkatkan keterampilan desain dan multimedia Anda dengan materi berbasis proyek khusus untuk Siswa SMK. Pelajari tools industri, buat portofolio, dan siapkan karirmu.
                        </p>
                        
                        <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                            <a href="{{ route('register') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white bg-indigo-600 rounded-xl hover:bg-indigo-500 hover:-translate-y-1 focus:ring-4 focus:ring-indigo-500/50 transition-all duration-300 shadow-xl shadow-indigo-600/40">
                                Mulai Belajar Sekarang
                                <svg class="w-5 h-5 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                            </a>
                            <a href="{{ route('login') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 text-base font-bold text-slate-300 bg-slate-800 rounded-xl hover:bg-slate-700 hover:text-white transition-all duration-300 border border-slate-700">
                                Sudah punya akun? Login
                            </a>
                        </div>
                    </div>

                    <div class="hidden lg:block relative">
                        <div class="relative w-full aspect-square max-w-lg mx-auto">
                            <div class="absolute inset-0 bg-gradient-to-tr from-indigo-500/10 to-teal-400/10 rounded-3xl transform rotate-3 border border-slate-700/50 backdrop-blur-3xl"></div>
                            
                            <div class="absolute inset-4 bg-slate-800 rounded-2xl shadow-2xl overflow-hidden border border-slate-700 flex flex-col">
                                <div class="h-12 bg-slate-900 border-b border-slate-700 flex items-center px-4 gap-2">
                                    <div class="w-3 h-3 rounded-full bg-slate-600"></div>
                                    <div class="w-3 h-3 rounded-full bg-slate-600"></div>
                                    <div class="w-3 h-3 rounded-full bg-slate-600"></div>
                                </div>
                                <div class="flex-1 p-6 flex flex-col gap-4">
                                    <div class="h-8 w-1/3 bg-slate-700 rounded-lg"></div>
                                    <div class="h-32 w-full bg-slate-700 rounded-xl overflow-hidden relative">
                                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-slate-600/20 to-transparent -translate-x-full animate-[shimmer_2s_infinite]"></div>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4 mt-auto">
                                        <div class="h-24 bg-indigo-500/20 border border-indigo-500/30 rounded-xl"></div>
                                        <div class="h-24 bg-teal-500/20 border border-teal-500/30 rounded-xl"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="absolute -right-6 top-1/4 bg-slate-800 border border-slate-700 p-4 rounded-xl shadow-2xl flex items-center gap-4 animate-bounce hover:pause" style="animation-duration: 3s;">
                                <div class="w-12 h-12 bg-teal-500/20 rounded-full flex items-center justify-center text-2xl">🏆</div>
                                <div>
                                    <div class="text-sm font-bold text-white">Project-Based</div>
                                    <div class="text-xs text-slate-400">Learning</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-24 bg-slate-50 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4 tracking-tight">Dirancang untuk Calon Kreator</h2>
                    <p class="text-lg text-slate-600">Fitur unggulan yang memudahkan proses belajar, praktik, dan evaluasi dalam satu platform terpadu.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white rounded-3xl p-8 shadow-xl shadow-slate-200/50 border border-slate-100 hover:-translate-y-2 hover:shadow-2xl hover:border-indigo-100 transition-all duration-300 group">
                        <div class="w-16 h-16 rounded-2xl bg-indigo-50 flex items-center justify-center text-3xl mb-8 group-hover:bg-indigo-600 group-hover:scale-110 transition-all duration-300">
                            <span class="group-hover:grayscale-0">🎨</span>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-indigo-600 transition-colors">Materi Praktik DKV</h3>
                        <p class="text-slate-600 leading-relaxed">
                            Modul disusun khusus untuk kebutuhan industri kreatif. Pelajari fundamental desain hingga penguasaan perangkat lunak terkini.
                        </p>
                    </div>

                    <div class="bg-white rounded-3xl p-8 shadow-xl shadow-slate-200/50 border border-slate-100 hover:-translate-y-2 hover:shadow-2xl hover:border-teal-100 transition-all duration-300 group">
                        <div class="w-16 h-16 rounded-2xl bg-teal-50 flex items-center justify-center text-3xl mb-8 group-hover:bg-teal-500 group-hover:scale-110 transition-all duration-300">
                            <span>📈</span>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-teal-600 transition-colors">Pantau Progres</h3>
                        <p class="text-slate-600 leading-relaxed">
                            Ketahui sejauh mana perkembangan belajarmu di setiap kelas. Sistem cerdas kami mencatat setiap aktivitas dan pencapaianmu.
                        </p>
                    </div>

                    <div class="bg-white rounded-3xl p-8 shadow-xl shadow-slate-200/50 border border-slate-100 hover:-translate-y-2 hover:shadow-2xl hover:border-indigo-100 transition-all duration-300 group">
                        <div class="w-16 h-16 rounded-2xl bg-blue-50 flex items-center justify-center text-3xl mb-8 group-hover:bg-blue-600 group-hover:scale-110 transition-all duration-300">
                            <span>✍️</span>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-blue-600 transition-colors">Evaluasi Mandiri</h3>
                        <p class="text-slate-600 leading-relaxed">
                            Uji pemahamanmu melalui kuis interaktif di akhir materi. Dapatkan umpan balik instan untuk memperbaiki kelemahanmu.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-slate-900 border-t border-slate-800 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-teal-400 flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <span class="text-xl font-extrabold tracking-tight text-slate-200">LMS Vokasi</span>
            </div>
            
            <p class="text-sm text-slate-400 font-medium">
                &copy; {{ date('Y') }} LMS Vokasi SMKN Kebonagung. All rights reserved.
            </p>
        </div>
    </footer>

    <style>
        @keyframes shimmer {
            100% { transform: translateX(100%); }
        }
        .bg-300\% { background-size: 300% 300%; }
        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .animate-gradient {
            animation: gradient-shift 6s ease infinite;
        }
    </style>
</body>
</html>