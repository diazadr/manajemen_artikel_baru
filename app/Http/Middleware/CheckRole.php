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
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Redirect jika user tidak login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Periksa apakah role user ada di daftar yang diperbolehkan
        if (!in_array(Auth::user()->role, $roles)) {
            abort(403); // Forbidden
        }

        return $next($request);
    }
}
