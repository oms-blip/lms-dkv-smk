<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Guru - DKV Learn</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-slate-900 bg-gradient-to-br from-[#0f172a] to-[#1e3a8a] min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-[400px] bg-white rounded-[2rem] p-8 sm:p-10 shadow-2xl">
        
        <!-- Ikon Guru Tambahan Biar Keren -->
        <div class="flex justify-center mb-4">
            <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
        </div>

        <h2 class="text-2xl font-extrabold text-center text-slate-900 mb-8 tracking-tight">Portal Login Guru</h2>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            
            <div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Masukan Email Guru" 
                    class="w-full px-4 py-3.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:border-[#0056d2] focus:ring-1 focus:ring-[#0056d2] outline-none transition-all">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Masukan Password" 
                    class="w-full px-4 py-3.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:border-[#0056d2] focus:ring-1 focus:ring-[#0056d2] outline-none transition-all">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex justify-start">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm font-medium text-[#0056d2] hover:underline">
                        Lupa password?
                    </a>
                @endif
            </div>

            <button type="submit" class="w-full py-3.5 bg-[#0f172a] text-white font-bold rounded-xl hover:bg-[#1e293b] transition-colors shadow-lg shadow-slate-900/20 text-sm">
                Login Panel Guru
            </button>
        </form>

        <div class="relative flex items-center py-5">
            <div class="flex-grow border-t border-slate-200"></div>
            <span class="flex-shrink-0 mx-4 text-slate-400 text-xs font-bold uppercase">Atau</span>
            <div class="flex-grow border-t border-slate-200"></div>
        </div>

        <a href="/auth/google" class="w-full flex items-center justify-center gap-3 px-4 py-3 border-2 border-slate-100 rounded-xl text-sm font-bold text-slate-700 hover:bg-slate-50 transition-colors">
            <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5" alt="Google Icon">
            Login dengan Google
        </a>
    </div>

</body>
</html>