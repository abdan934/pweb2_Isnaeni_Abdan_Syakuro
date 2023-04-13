<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;


class LoginController extends Controller
{
    //masuk
    public function index(){
        return view("pages/login");
    }

    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'username' => 'required',
            'password' => 'required|min:6'
        ],[
            'email.required' => 'Email wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.'
        ]);

        Session::flash('email',$request->email);
        Session::flash('username',$request->username);
        Session::flash('password',$request->password);
        $infologin = [
            'username' => $request->username,
            'password' => $request->password
        ];
        $infologin2 = $request->only('username', 'password');
        if(Auth::attempt($infologin2)){
            //berhasil
            // $username_login = Auth::user()->username;
            $username_login = $request->input('username');
            // $request->session()->put('username_login', $request->input('username'));
            // return redirect()->route('dashboard')->with('username_login', $username_login);
            return redirect()->route('dashboard');
              
        }else{
            //gagal
        $alert = 'error';
        $pesan = 'Username atau Password salah !!';
          return view('pages/login')->withInput($request->all())->with(['pesan'=>$pesan,'alert'=>$alert]);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    function register(Request $request){
        Session::flash('name',$request->name);
        Session::flash('email',$request->email);

        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users',
            'username' => 'required',
            'password' => 'required|min:6'
        ],[
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah terdaftar.',
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.'
        ]);

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password'))
        ];

        if ($validator->fails()) {
            $alert = 'warning';
            return view('pages/login')->withErrors($validator)->withInput($request->all())->with('alert',$alert);

        }else{
            User::create($data);
            $pesan = 'Berhasil ditambahkan';
            $alert = 'notice';
            return view('pages/login')->with(['pesan'=>$pesan,'alert'=>$alert]);
        }

    }

}
