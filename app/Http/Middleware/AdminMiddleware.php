<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah user sudah login
        // 2. Cek apakah role user adalah 'admin'
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Jika bukan admin, arahkan ke halaman beranda atau berikan error 403
        return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
