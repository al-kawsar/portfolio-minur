<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isSuperadmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function handle($request, Closure $next)
    {
        if (Auth::user()->role === "2") { // Ubah '2' menjadi 2 jika role adalah integer.
            // return "anda tidak memiliki izin";
            return redirect()->back()->with('not_permission', "Anda Tidak Berhak Mengakses Halaman Admin!");
        }

        return $next($request);
    }
}
