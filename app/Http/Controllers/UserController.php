<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\Matkul;
use App\Imports\UserImport;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = User::orderBy('id','asc')->paginate(10);
        $no = 1;
        $user = Auth::user();
        $usermhs = Mahasiswa::where('nim', $user->username)->first();
        $userdosen = Dosen::where('nidn', $user->username)->first();
        $url_data ='active';
        if (!is_null($usermhs)) {
            $role = 'mahasiswa';
        } elseif (!is_null($userdosen)) {
            $role = 'dosen';
        } else {
            $role = 'admin';
        }

        return view("pages/user/table_user")->with(['data'=>$data,'url_data'=>$url_data, 'role'=>$role,'no'=>$no,'user'=>$user]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = User::where('id',$id)->first();
        $user = Auth::user();
        // $user = Auth::user();
        $usermhs = Mahasiswa::where('nim', $user->username)->first();
        $userdosen = Dosen::where('nidn', $user->username)->first();
        if (!is_null($usermhs)) {
            $role = 'mahasiswa';
        } elseif (!is_null($userdosen)) {
            $role = 'dosen';
        } else {
            $role = 'admin';
        }
        return view('pages/user/edit_user')->with(['data'=>$data, 'role'=>$role,'user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user = Auth::user();
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
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ],[
            'name.required' => 'Nama wajib diisi.'
        ]);

        $request->validate ( [
            'name' => 'required',
            'username' => 'required'
        ],[
            'name.required' => 'Nama wajib diisi.',
            'username.required' => 'Userama wajib diisi.'
            
        ]);

        $data_update=[
            'name' => $request->input('name'),
            'username' => $request->input('username')
        ];

        if ($validator->fails()) {
            return view('pages/user/edit_user',['user'=>$user, 'role'=>$role]);

        }else{
            User::where('id',$id)->update($data_update);
            $pesan = 'Berhasil diubah';
            $data = User::orderBy('id','asc')->paginate(10);
            $no = 1;
        return view("pages/user/table_user")->with(['data'=>$data, 'role'=>$role,'no'=>$no,'user'=>$user,'isipesan'=>$pesan]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
            User::where('id',$id)->delete();
            $pesan = 'Berhasil dihapus';
            // $data = Matkul::orderBy('nidn','asc')->paginate(10);
            $data = User::orderBy('id','asc')->paginate(10);
            $no = 1;
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
        $url_data ='active';
        // return redirect('/datauser')->with(['data' => $data, 'url_data' => $url_data, 'isipesan' => $pesan, 'role' => $role, 'no' => $no, 'user' => $user]);
        // return redirect()->route('datauser');
        // return redirect('datauser')->with(['isipesan'=>$pesan]);
        return view("pages/user/table_user")->with(['data'=>$data, 'role'=>$role,'no'=>$no,'isipesan'=>$pesan,'url_data'=>$url_data,'user'=>$user]);
    }

    public function importexcel(Request $request){

        
    
        $data = $request->file('file');

        $namafile = $data->getClientOriginalName();
        $data->move('UserData',$namafile);
        $import = new UserImport;
        $path = public_path('/UserData/'.$namafile);
        $rows = Excel::toArray($import, $path);
        $data_isi = User::orderBy('id','asc')->paginate(10);
        $no = 1;
        $user = Auth::user();
        $usermhs = Mahasiswa::where('nim', $user->username)->first();
        $userdosen = Dosen::where('nidn', $user->username)->first();
        $url_data ='active';
        if (!is_null($usermhs)) {
            $role = 'mahasiswa';
        } elseif (!is_null($userdosen)) {
            $role = 'dosen';
        } else {
            $role = 'admin';
        }
        foreach ($rows[0] as $row) {
            // Sesi pemeriksaan
            $email = $row[2];
            $checkdata = User::where('email', $email)->first();
            if ($checkdata) {
                $pesan = 'Data sudah ada silahkan cek kembali!!';
                return view("pages/user/table_user")->with(['data'=>$data_isi,'url_data'=>$url_data,'pesangagal'=>$pesan, 'role'=>$role,'no'=>$no,'user'=>$user]);
            } else {
                //sesi berhasil
                $pesan = 'Berhasil diimport';
        Excel::import(new UserImport, \public_path('/UserData/'.$namafile));
        // return redirect('/datauser')->with(['data' => $data_isi, 'url_data' => $url_data, 'pesan' => $pesan, 'role' => $role, 'no' => $no, 'user' => $user]);
        return view("pages/user/table_user")->with(['data'=>$data_isi,'url_data'=>$url_data,'pesan'=>$pesan ,'role'=>$role,'no'=>$no,'user'=>$user]);
            }
        }
    }
}
