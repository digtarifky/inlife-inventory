<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $userRole = Auth::user()->role->name;

        // Jika role user ada di dalam daftar role yang diizinkan, lanjutkan request
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // Jika tidak, kembalikan ke halaman dashboard
        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}