<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            if (!Auth::check()) {
                if ($request->session()->has('last_activity')) {
                    session()->flash('error', 'Sesi Anda telah habis! harap login kembali.');
                } else {
                    session()->flash('error', 'Anda belum login.');
                }

            }

            return route('login');
        }

        return null;
    }
}
