<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matkul;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class MatkulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Matkul::get();
        // dd($data->first()->id_matkul);
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

        $no = 1;
            return view("pages/matakuliah/table_matakuliah")->with(['data'=>$data,'url_data'=>$url_data,'no'=>$no,'user'=>$user, 'role'=>$role]);
            // return dd($data);
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
        return view('pages/matakuliah/create_matakuliah',['user'=>$user, 'role'=>$role]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        Session::flash('nidn',$request->nidn);
        Session::flash('nama_dosen',$request->nama_dosen);
        Session::flash('email',$request->email);
        Session::flash('jurusan',$request->jurusan);
        
        $request->validate ( [
            'id_matkul' => 'required|uppercase|unique:table_matkul',
            'nama_matkul'=> 'required|uppercase',
            'nidn' => [
                'required',
                Rule::exists('table_dosen', 'nidn')]
        ],[ 
            'id_matkul.required' => 'Kode Mata Kuliah wajib diisi',
            'id_matkul.unique' => 'Kode Mata Kuliah sudah terdaftar',
            'id_matkul.uppercase' => 'Kode Mata Kuliah wajin kapital',
            'nama_matkul.required' => 'Nama Mata Kuliah wajib diisi',
            'nama_matkul.uppercase' => 'Nama Mata Kuliah wajib kapital',
            'nidn.required' => 'NIDN wajib diisi',
            'nidn.exists' => 'NIDN tidak ditemukan'
        ]);
        $validator = Validator::make($request->all(), [
            'id_matkul' => 'required|uppercase|unique:table_matkul',
            'nama_matkul'=> 'required|uppercase',
            'nidn' => [
                'required',
                'uppercase',
                Rule::exists('table_dosen', 'nidn')]
        ],[ 
            'id_matkul.required' => 'Kode Mata Kuliah wajib diisi',
            'id_matkul.unique' => 'Kode Mata Kuliah sudah terdaftar',
            'id_matkul.uppercase' => 'Kode Mata Kuliah wajin kapital',
            'nama_matkul.required' => 'Nama Mata Kuliah wajib diisi',
            'nama_matkul.uppercase' => 'Nama Mata Kuliah wajib kapital',
            'nidn.required' => 'NIDN wajib diisi',
            'nidn.uppercase' => 'NIDN wajib kapital',
            'nidn.exists' => 'NIDN tidak ditemukan'
        ]);
        $data_create=[
            'id_matkul' => $request->input('id_matkul'),
            'nidn' => $request->input('nidn'),
            'nama_matkul' => $request->input('nama_matkul')
        ];
        $user = Auth::user();
        if ($validator->fails()) {
            return redirect('matakuliah',['user'=>$user]);

        }else{
            Matkul::create($data_create);
            $pesan = 'Berhasil';
            $data = Matkul::all();
            $no = 1;
            $usermhs = Mahasiswa::where('nim', $user->username)->first();
        $userdosen = Dosen::where('nidn', $user->username)->first();
        if (!is_null($usermhs)) {
            $role = 'mahasiswa';
        } elseif (!is_null($userdosen)) {
            $role = 'dosen';
        } else {
            $role = 'admin';
        }
                return view("pages/matakuliah/table_matakuliah")->with(['data'=>$data, 'role'=>$role,'no'=>$no,'user'=>$user,'pesan'=>$pesan]);
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
        $data = Matkul::where('id_matkul',$id)->first();
        $usermhs = Mahasiswa::where('nim', $user->username)->first();
        $userdosen = Dosen::where('nidn', $user->username)->first();
        if (!is_null($usermhs)) {
            $role = 'mahasiswa';
        } elseif (!is_null($userdosen)) {
            $role = 'dosen';
        } else {
            $role = 'admin';
        }
        return view('pages/matakuliah/edit_matakuliah')->with(['data'=>$data, 'role'=>$role,'user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate ( [
            'id_matkul' => 'required|uppercase|unique:table_matkul',
            'nama_matkul'=> 'required|uppercase',
            'nidn' => [
                'required',
                'uppercase',
                Rule::exists('table_dosen', 'nidn')]
        ],[ 
            'id_matkul.required' => 'Kode Mata Kuliah wajib diisi',
            'id_matkul.unique' => 'Kode Mata Kuliah sudah terdaftar',
            'id_matkul.uppercase' => 'Kode Mata Kuliah wajin kapital',
            'nama_matkul.required' => 'Nama Mata Kuliah wajib diisi',
            'nama_matkul.uppercase' => 'Nama Mata Kuliah wajib kapital',
            'nidn.required' => 'NIDN wajib diisi',
            'nidn.uppercase' => 'NIDN wajib kapital',
            'nidn.exists' => 'NIDN tidak ditemukan'
        ]);
        $validator = Validator::make($request->all(), [
            'id_matkul' => 'required|uppercase|unique:table_matkul',
            'nama_matkul'=> 'required|uppercase',
            'nidn' => [
                'required',
                'uppercase',
                Rule::exists('table_dosen', 'nidn')]
        ],[ 
            'id_matkul.required' => 'Kode Mata Kuliah wajib diisi',
            'id_matkul.unique' => 'Kode Mata Kuliah sudah terdaftar',
            'id_matkul.uppercase' => 'Kode Mata Kuliah wajin kapital',
            'nama_matkul.required' => 'Nama Mata Kuliah wajib diisi',
            'nama_matkul.uppercase' => 'Nama Mata Kuliah wajib kapital',
            'nidn.required' => 'NIDN wajib diisi',
            'nidn.uppercase' => 'NIDN wajib kapital',
            'nidn.exists' => 'NIDN tidak ditemukan'
        ]);

        $data_update=[
            'nidn' => $request->input('nidn'),
            'nama_matkul' => $request->input('nama_matkul')
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
            Mahasiswa::where('nim',$id)->update($data_update);
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
        $matkul = Matkul::where('id_matkul', $id)->first();
            Dosen::where('nidn',$id)->delete();
            $pesan = 'Berhasil dihapus';
            // $data = Matkul::orderBy('nidn','asc')->paginate(5);
            $data = Matkul::all();
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
        return view("pages/matakuliah/table_matakuliah")->with(['data'=>$data, 'role'=>$role,'no'=>$no,'isipesan'=>$pesan,'user'=>$user]);
        
    }
}
