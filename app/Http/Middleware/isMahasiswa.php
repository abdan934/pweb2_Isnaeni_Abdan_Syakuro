<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use App\Models\Dosen;

class isMahasiswa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $usermhs = Mahasiswa::where('nim', $user->username)->first();
        $userdosen = Dosen::where('nidn', $user->username)->first();
        if (!is_null($usermhs)) {
            $role = 'mahasiswa';
        } elseif (!is_null($userdosen)) {
            $role = 'dosen';
        } else {
            $role = 'admin';
        }

        if ($role == 'mahasiswa') {
            
            return $next($request);
        } else {
            
            return redirect('/dashboard')->withErrors('Akses Terbatas!!');
        }
    }
}
