<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa - DKV Learn</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-slate-900 bg-gradient-to-br from-[#96b8ff] to-[#dfbbf6] min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-[400px] bg-white rounded-[2rem] p-8 sm:p-10 shadow-2xl">
        <h2 class="text-3xl font-extrabold text-center text-slate-900 mb-6 tracking-tight">Portal Siswa</h2>

        <div class="flex p-1 bg-white border border-slate-200 rounded-full mb-8 text-sm font-bold shadow-sm">
            <a href="{{ route('login') }}" class="flex-1 text-center py-2.5 rounded-full bg-[#0056d2] text-white shadow-md transition-all">
                Login
            </a>
            <a href="{{ route('register') }}" class="flex-1 text-center py-2.5 rounded-full text-slate-500 hover:text-slate-800 transition-all">
                Daftar
            </a>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            
          <div class="relative mb-4">
                <input type="email" name="email" required placeholder="username" 
                    class="w-full px-4 py-3.5 bg-[#f0f4f8] border border-transparent focus:bg-white focus:border-[#0052cc] focus:ring-2 focus:ring-[#0052cc]/20 rounded-xl text-sm font-medium outline-none transition-all">
            </div>
           <div class="relative mb-6" x-data="{ show: false }">
                <input :type="show ? 'text' : 'password'" name="password" required placeholder="password" 
                    class="w-full pl-4 pr-12 py-3.5 bg-[#f0f4f8] border border-[#0052cc] focus:bg-white focus:border-[#0052cc] focus:ring-2 focus:ring-[#0052cc]/20 rounded-xl text-sm font-medium outline-none transition-all">
                
                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 hover:text-[#0052cc] transition-colors outline-none focus:outline-none">
                    
                    <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    
                    <svg x-show="show" style="display: none;" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                    </svg>

                </button>
            </div>

            <div class="flex justify-start">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm font-medium text-[#0056d2] hover:underline">
                        Lupa password?
                    </a>
                @endif
            </div>

            <button type="submit" class="w-full py-3.5 bg-[#0047b3] text-white font-bold rounded-xl hover:bg-[#00388f] transition-colors shadow-lg shadow-blue-900/20 text-sm">
                Login
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

        <p class="text-center text-sm text-slate-600 mt-8 font-medium">
            Belum punya akun? <a href="{{ route('register') }}" class="text-[#0056d2] hover:underline">Daftar sekarang</a>
        </p>
    </div>

</body>
</html>