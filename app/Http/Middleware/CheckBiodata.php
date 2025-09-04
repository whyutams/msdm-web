<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckBiodata
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            $requiredFields = [
                'usia',
                'pendidikan',
                'pekerjaan',
                'status_perkawinan',
                'lama_dm',
                'pengobatan_dm',
                'riwayat_keluarga',
                'diabetes_type',
            ];

            foreach ($requiredFields as $field) {
                if (empty($user->$field)) {
                    if (!$request->routeIs('biodata.edit') && !$request->routeIs('biodata.update')) {
                        return redirect()->route('biodata.edit')->with('success',session('success'));
                    }
                }
            }
        }

        return $next($request);
    }
}
