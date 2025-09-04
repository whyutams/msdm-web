<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckSuspended
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->suspended && Auth::user()->role != User::ROLE_SUPERADMIN) {
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'username' => 'Maaf, akun Anda dinonaktifkan!',
            ]);
        }

        return $next($request);
    }
}
