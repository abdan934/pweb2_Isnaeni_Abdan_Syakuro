<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class isTamu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        

        if(Auth::check()){
            $pesan = 'Log Out terlebih dahulu';
            // $username_login = $request->session()->get('username_login');
            $username_login = $request->input('username');
        $request->session()->put('username_login', $username_login);
        return redirect('/dashboard')->withErrors($pesan)->with('username_login',$username_login);
        }
        return $next($request);
    
    }
}
