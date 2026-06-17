<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     * parameter ...$roles memungkinkan kita mengirim banyak role sekaligus dipisahkan koma
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Pastikan user sudah login
        if (!Auth::check()) {
            return redirect('login');
        }

        // 2. Cek apakah role user saat ini ada di dalam array $roles yang diizinkan
        if (in_array(Auth::user()->role, $roles)) {
            return $next($request);
        }

        // 3. Jika tidak punya akses, lemparkan error 403 Forbidden
        abort(403, 'Akses Ditolak! Anda tidak memiliki izin untuk membuka halaman ini.');
    }
}