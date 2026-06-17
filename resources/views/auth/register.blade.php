<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - DKV Learn</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-slate-900 bg-gradient-to-br from-[#96b8ff] to-[#dfbbf6] min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-[400px] bg-white rounded-[2rem] p-8 sm:p-10 shadow-2xl">
        <h2 class="text-3xl font-extrabold text-center text-slate-900 mb-6 tracking-tight">Form Registrasi</h2>

        <div class="flex p-1 bg-white border border-slate-200 rounded-full mb-8 text-sm font-bold shadow-sm">
            <a href="{{ route('login') }}" class="flex-1 text-center py-2.5 rounded-full text-slate-500 hover:text-slate-800 transition-all">
                Login
            </a>
            <a href="{{ route('register') }}" class="flex-1 text-center py-2.5 rounded-full bg-[#0056d2] text-white shadow-md transition-all">
                Daftar
            </a>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            
            <div>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Nama lengkap" 
                    class="w-full px-4 py-3.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:border-[#0056d2] focus:ring-1 focus:ring-[#0056d2] outline-none transition-all">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="Masukan Email" 
                    class="w-full px-4 py-3.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:border-[#0056d2] focus:ring-1 focus:ring-[#0056d2] outline-none transition-all">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <input id="phone" type="text" name="phone" value="{{ old('phone') }}" required placeholder="Nomor Telepon" 
                    class="w-full px-4 py-3.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:border-[#0056d2] focus:ring-1 focus:ring-[#0056d2] outline-none transition-all">
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <div>
                <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Masukan Password" 
                    class="w-full px-4 py-3.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:border-[#0056d2] focus:ring-1 focus:ring-[#0056d2] outline-none transition-all">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password" 
                    class="w-full px-4 py-3.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:border-[#0056d2] focus:ring-1 focus:ring-[#0056d2] outline-none transition-all">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <button type="submit" class="w-full py-3.5 bg-[#0047b3] text-white font-bold rounded-xl hover:bg-[#00388f] transition-colors shadow-lg shadow-blue-900/20 text-sm mt-2">
                Daftar
            </button>
        </form>

        <p class="text-center text-sm text-slate-600 mt-6 font-medium">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-[#0056d2] hover:underline">Login sekarang</a>
        </p>
    </div>

</body>
</html>