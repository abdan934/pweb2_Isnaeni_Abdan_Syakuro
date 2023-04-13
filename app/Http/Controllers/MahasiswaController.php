<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Nilai;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        //
        $data = Mahasiswa::orderBy('nim','asc')->paginate(5);
        $no = 1;
        $user = Auth::user();
        $url_data ='active';
        $usermhs = Mahasiswa::where('nim', $user->username)->first();
        $userdosen = Dosen::where('nidn', $user->username)->first();
        if (!is_null($usermhs)) {
            $role = 'mahasiswa';
        } elseif (!is_null($userdosen)) {
            $role = 'dosen';
        } else {
            $role = 'admin';
        }

        return view("pages/mahasiswa/table_mahasiswa")->with(['data'=>$data,'url_data'=>$url_data ,'role'=>$role,'no'=>$no,'user'=>$user]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $user = Auth::user();
        $url_data ='active';
        $usermhs = Mahasiswa::where('nim', $user->username)->first();
        $userdosen = Dosen::where('nidn', $user->username)->first();
        if (!is_null($usermhs)) {
            $role = 'mahasiswa';
        } elseif (!is_null($userdosen)) {
            $role = 'dosen';
        } else {
            $role = 'admin';
        }
        return view("pages/mahasiswa/create_mahasiswa",['user'=>$user, 'role'=>$role,'url_data'=>$url_data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate ( [
            'nim' => 'required|unique:table_mahasiswa',
            'nama_mhs'=> 'required',
            'email'=> 'required|email',
            'jurusan'=> 'required|uppercase'
        ],[ 
            'nim.required' => 'NIM wajib diisi',
            'nim.unique' => 'NIM sudah terdaftar',
            'nama_mahasiswa.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'jurusan.required' => 'Jurusan wajib diisi',
            'jurusan.uppercase' => 'Jurusan wajib kapital'
        ]);
        $validator = Validator::make($request->all(),  [
            'nim' => 'required|unique:table_mahasiswa',
            'nama_mhs'=> 'required',
            'email'=> 'required|email',
            'jurusan'=> 'required|uppercase'
        ],[ 
            'nim.required' => 'NIM wajib diisi',
            'nim.unique' => 'NIM sudah terdaftar',
            'nama_mahasiswa.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'jurusan.required' => 'Jurusan wajib diisi',
            'jurusan.uppercase' => 'Jurusan wajib kapital'
        ]);

        $data_create=[
            'nim' => $request->input('nim'),
            'nama_mhs' => $request->input('nama_mhs'),
            'email' => $request->input('email'),
            'jurusan' => $request->input('jurusan')
        ];
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
        if ($validator->fails()) {
            return redirect('mahasiswa/create',['user'=>$user, 'role'=>$role]);

        }else{
            Mahasiswa::create($data_create);
            $pesan = 'Berhasil ditambahkan';
            $data = Mahasiswa::orderBy('nim','asc')->paginate(5);
            $no = 1;
            return view("pages/mahasiswa/table_mahasiswa")->with(['data'=>$data, 'role'=>$role,'no'=>$no,'isipesan'=>$pesan,'user'=>$user]);
        }
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
        $user = Auth::user();
        $data = Mahasiswa::where('nim',$id)->first();
        $usermhs = Mahasiswa::where('nim', $user->username)->first();
        $userdosen = Dosen::where('nidn', $user->username)->first();
        if (!is_null($usermhs)) {
            $role = 'mahasiswa';
        } elseif (!is_null($userdosen)) {
            $role = 'dosen';
        } else {
            $role = 'admin';
        }
        return view('pages/mahasiswa/edit_mahasiswa')->with(['data'=>$data, 'role'=>$role,'user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate ( [
            'nama_mhs'=> 'required',
            'email'=> 'required|email',
            'jurusan'=> 'required|uppercase'
        ],[ 
            'nama_mhs.required' => 'Nama  wajib diisi',
            'email.required' => 'Email wajib diisi',
            'jurusan.required' => 'Jurusan wajib diisi',
            'jurusan.uppercase' => 'Jurusan wajib kapital'
        ]);
        $validator = Validator::make($request->all(),  [
            'nama_mhs'=> 'required',
            'email'=> 'required|email',
            'jurusan'=> 'required|uppercase'
        ],[ 
            'nama_mhs.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'jurusan.required' => 'Jurusan wajib diisi',
            'jurusan.uppercase' => 'Jurusan wajib kapital'
        ]);

        $data=[
            'nama_mhs' => $request->input('nama_mhs'),
            'email' => $request->input('email'),
            'jurusan' => $request->input('jurusan')
        ];
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
        if ($validator->fails()) {
            return view('pages/mahasiswa/edit_mahasiswa',['user'=>$user, 'role'=>$role]);

        }else{
            Mahasiswa::where('nim',$id)->update($data);
            $pesan = 'Berhasil diubah';
            $data = Mahasiswa::orderBy('nim','asc')->paginate(5);
            $no = 1;
            return view("pages/mahasiswa/table_mahasiswa")->with(['data'=>$data, 'role'=>$role,'no'=>$no,'isipesan'=>$pesan,'user'=>$user]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $mahasiswa = Mahasiswa::where('nim', $id)->first();
        $nilai = Nilai::where('nim', $mahasiswa->nim)->first();
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
        if ($nilai !== null) {
            $pesan = 'Gagal hapus';
            // $data = Nilai::orderBy('nidn','asc')->paginate(5);
            $data = Mahasiswa::orderBy('nim','asc')->paginate(5);
            $no = 1;
            return view("pages/mahasiswa/table_mahasiswa")->with(['data'=>$data, 'role'=>$role,'no'=>$no,'pesangagal'=>$pesan,'user'=>$user]);
            
       
        } else {
            Mahasiswa::where('nim',$id)->delete();
            $pesan = 'Berhasil dihapus';
            $data = Mahasiswa::orderBy('nim','asc')->paginate(5);
            $no = 1;
            return view("pages/mahasiswa/table_mahasiswa")->with(['data'=>$data, 'role'=>$role,'no'=>$no,'pesangagal'=>$pesan,'user'=>$user]);
            
        }
    }
}
