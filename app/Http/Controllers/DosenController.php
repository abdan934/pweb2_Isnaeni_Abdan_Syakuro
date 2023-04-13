<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Matkul;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();
        $data = Dosen::orderBy('nidn','asc')->paginate(5);
        $no = 1;
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

        return view("pages/dosen/table_dosen")->with(['data'=>$data,'url_data'=>$url_data,'no'=>$no,'user'=>$user, 'role'=>$role]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        return view('pages/dosen/create_dosen',['user'=>$user, 'role'=>$role]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate ( [
            'nidn' => 'required|unique:table_dosen',
            'nama_dosen'=> 'required',
            'email'=> 'required|email',
            'jurusan'=> 'required|uppercase'
        ],[ 
            'nidn.required' => 'NIDN wajib diisi',
            'nidn.unique' => 'NIDN sudah terdaftar',
            'nama_dosen.required' => 'Nama Mata Kuliah wajib diisi',
            'email.required' => 'Email wajib diisi',
            'jurusan.required' => 'Jurusan wajib diisi',
            'jurusan.uppercase' => 'Jurusan wajib kapital'
        ]);
        $validator = Validator::make($request->all(),  [
            'nidn' => 'required|unique:table_dosen',
            'nama_dosen'=> 'required',
            'email'=> 'required|email',
            'jurusan'=> 'required|uppercase'
        ],[ 
            'nidn.required' => 'NIDN wajib diisi',
            'nidn.unique' => 'NIDN sudah terdaftar',
            'nama_dosen.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'jurusan.required' => 'Jurusan wajib diisi',
            'jurusan.uppercase' => 'Jurusan wajib kapital'
        ]);

        $data_create=[
            'nidn' => $request->input('nidn'),
            'nama_dosen' => $request->input('nama_dosen'),
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
            return redirect('dosen/create',['user'=>$user, 'role'=>$role]);

        }else{
            Dosen::create($data_create);
            $data = Dosen::orderBy('nidn','asc')->paginate(5);
            $pesan = 'Berhasil ditambahkan';
            $no = 1;
            return view("pages/dosen/table_dosen")->with(['data'=>$data, 'role'=>$role,'no'=>$no,'isipesan'=>$pesan,'user'=>$user]);
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
        $data = Dosen::where('nidn',$id)->first();
        $usermhs = Mahasiswa::where('nim', $user->username)->first();
        $userdosen = Dosen::where('nidn', $user->username)->first();
        if (!is_null($usermhs)) {
            $role = 'mahasiswa';
        } elseif (!is_null($userdosen)) {
            $role = 'dosen';
        } else {
            $role = 'admin';
        }
        return view('pages/dosen/edit_dosen')->with(['data'=>$data, 'role'=>$role,'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate ( [
            'nama_dosen'=> 'required',
            'email'=> 'required|email',
            'jurusan'=> 'required|uppercase'
        ],[ 
            'nama_dosen.required' => 'Nama Dosen wajib diisi',
            'email.required' => 'Email wajib diisi',
            'jurusan.required' => 'Jurusan wajib diisi',
            'jurusan.uppercase' => 'Jurusan wajib kapital'
        ]);
        $validator = Validator::make($request->all(),  [
            'nama_dosen'=> 'required',
            'email'=> 'required|email',
            'jurusan'=> 'required|uppercase'
        ],[ 
            'nama_dosen.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'jurusan.required' => 'Jurusan wajib diisi',
            'jurusan.uppercase' => 'Jurusan wajib kapital'
        ]);

        $data_update=[
            'nama_dosen' => $request->input('nama_dosen'),
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
            return view('pages/dosen/edit_dosen',['user'=>$user, 'role'=>$role]);

        }else{
            Dosen::where('nidn',$id)->update($data_update);
            $pesan = 'Berhasil diubah';
            $data = Dosen::orderBy('nidn','asc')->paginate(5);
            $no = 1;
        return view("pages/dosen/table_dosen")->with(['data'=>$data,'no'=>$no, 'role'=>$role,'user'=>$user,'isipesan'=>$pesan]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $dosen = Dosen::where('nidn', $id)->first();
        $mataKuliah = Matkul::where('nidn', $dosen->nidn)->first();
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
        if ($mataKuliah !== null) {
            $pesan = 'Gagal hapus';
            $data = Dosen::orderBy('nidn','asc')->paginate(5);
            $no = 1;
        return view("pages/dosen/table_dosen")->with(['data'=>$data,'no'=>$no,'pesangagal'=>$pesan,'user'=>$user,'role'=>$role]);
            
       
        } else {
            Dosen::where('nidn',$id)->delete();
            $pesan = 'Berhasil dihapus';
            $data = Dosen::orderBy('nidn','asc')->paginate(5);
            $no = 1;
        return view("pages/dosen/table_dosen")->with(['data'=>$data,'no'=>$no,'isipesan'=>$pesan,'user'=>$user,'role'=>$role]);
        }
        
    }
}
