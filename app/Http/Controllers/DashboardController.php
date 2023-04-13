<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\Dosen;

class DashboardController extends Controller
{
    public function index(Request $request){
        $username_login = $request->session()->get('username_login');
        // return view('pages/dashboard',['username_login'=>$username_login]);
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
        $url_dashboard = 'active';
        return view('pages/dashboard', [
            'user' => $user, 'role'=>$role,'url_dashboard'=>$url_dashboard
        ]);
    }
}
