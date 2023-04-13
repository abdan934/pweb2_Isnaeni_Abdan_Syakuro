<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matkul;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Nilai;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\isDosen;

class NilaibyDosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $data = Nilai::all();
        $data = Nilai::orderBy('id_matkul','asc')->paginate(5);
        $user = Auth::user();
        $no = 1;
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

            return view("pages/dosen/table_nilaibydosen")->with(['data'=>$data,'url_datanilai'=>$url_data ,'role'=>$role,'no'=>$no,'user'=>$user]);
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
        $url_data ='active';
        if (!is_null($usermhs)) {
            $role = 'mahasiswa';
        } elseif (!is_null($userdosen)) {
            $role = 'dosen';
        } else {
            $role = 'admin';
        }
        return view("pages/dosen/create_nilaibydosen",['user'=>$user, 'role'=>$role,'url_datanilai'=>$url_data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        Session::flash('id_matkul',$request->id_matkul);
        Session::flash('nim',$request->nim);

        $request->validate ( [
            'id_matkul' => [
                'required',
                'uppercase',
                Rule::exists('table_matkul', 'id_matkul')],
            'nim' => [
                'required',
                Rule::exists('table_mahasiswa', 'nim')],
            'angka'=> 'required|min:1',
            'predikat'=> 'uppercase',
            'semester'=> 'required|uppercase'
        ],[ 
            'id_matkul.required' => 'Kode Mata Kuliah wajib diisi',
            'id_matkul.uppercase' => 'Kode Mata Kuliah wajib kapital',
            'id_matkul.exists' => 'Kode Mata Kuliah tidak ditemukan',
            'nim.required' => 'NIM    wajib diisi',
            'nim.exists' => 'NIM tidak ditemukan',
            'angka.required' => 'Nilai wajib diisi',
            'predikat.uppercase' => 'Predikat wajib diisi dengan kapital',
            'tahun_ajaran.required' => 'Tahun Ajaran wajib diisi dengan kapital',
            'semester.required' => 'Semester wajib diisi ',
        ]);
        $validator = Validator::make($request->all(), [
            'id_matkul' => [
                'required',
                'uppercase',
                Rule::exists('table_matkul', 'id_matkul')],
            'nim' => [
                'required',
                Rule::exists('table_mahasiswa', 'nim')],
            'angka'=> 'required|min:1',
            'predikat'=> 'uppercase',
            'tahun_ajaran'=> 'required',
            'semester'=> 'required'
        ],[ 
            'id_matkul.required' => 'Kode Mata Kuliah wajib diisi',
            'id_matkul.uppercase' => 'Kode Mata Kuliah wajib kapital',
            'id_matkul.exists' => 'Kode Mata Kuliah tidak ditemukan',
            'nim.required' => 'NIM    wajib diisi',
            'nim.exists' => 'NIM tidak ditemukan',
            'angka.required' => 'Nilai wajib diisi',
            
            'predikat.uppercase' => 'Predikat wajib diisi dengan kapital',
            'tahun_ajaran.required' => 'Tahun Ajaran wajib diisi dengan kapital',
            'semester.required' => 'Semester wajib diisi ',
        ]);

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
        $angka = $request->input('angka');

        if ($angka >= 90) {
    $predikat = 'A';
        } else if ($angka >= 80) {
    $predikat = 'AB';
        } else if ($angka >= 70) {
    $predikat = 'B';
        } else if ($angka >= 60) {
    $predikat = 'BC';
        } else if ($angka >= 40) {
    $predikat = 'C';
        } else{
    $predikat = 'D';
        }

        $data_create=[
            'nim' => $request->input('nim'),
            'id_matkul' => $request->input('id_matkul'),
            'angka' => $request->input('angka'),
            'predikat' => $predikat,
            'tahun_ajaran' => $request->input('tahun_ajaran'),
            'semester' => $request->input('semester')
        ];
        $data = Nilai::all();
        $no = 1;
        if ($validator->fails()) {
            return redirect('nilai/create');
        }else if ($angka < 0 && $angka >100){
            $url_data ='active';
            return redirect('nilaimahasiswa/create')->withErrors('Nilai harus kurang dari 100 dan positif')->with(['url_datanilai'=>$url_data]);
        }else{
            Nilai::create($data_create);
            $pesan = 'Berhasil ditambahkan';
            // $data = Nilai::all();
            $data = Nilai::orderBy('id_matkul','asc')->paginate(5);
            $no = 1;
                return view("pages/dosen/table_nilaibydosen")->with(['isipesan'=>$pesan,'user'=>$user, 'role'=>$role,'data'=>$data,'no'=>$no]);
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
        $data = nilai::where('no_nilai', $id)->first();
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
        return view("pages/dosen/edit_nilaibydosen")->with(['data'=>$data,'user'=>$user, 'role'=>$role,'url_datanilai'=>$url_data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate ( [
            'id_matkul' => [
                'required',
                'uppercase',
                Rule::exists('table_matkul', 'id_matkul')],
            'nim' => [
                'required',
                Rule::exists('table_mahasiswa', 'nim')],
            'angka'=> ['required'],
            'predikat'=> 'uppercase',
            'semester'=> 'required|uppercase'
        ],[ 
            'id_matkul.required' => 'Kode Mata Kuliah wajib diisi',
            'id_matkul.uppercase' => 'Kode Mata Kuliah wajib kapital',
            'id_matkul.exists' => 'Kode Mata Kuliah tidak ditemukan',
            'nim.required' => 'NIM    wajib diisi',
            'nim.exists' => 'NIM tidak ditemukan',
            'angka.required' => 'Nilai wajib diisi',
            
            'predikat.uppercase' => 'Predikat wajib diisi dengan kapital',
            'tahun_ajaran.required' => 'Tahun Ajaran wajib diisi dengan kapital',
            'semester.required' => 'Semester wajib diisi ',
        ]);
        $validator = Validator::make($request->all(), [
            'id_matkul' => [
                'required',
                'uppercase',
                Rule::exists('table_matkul', 'id_matkul')],
            'nim' => [
                'required',
                Rule::exists('table_mahasiswa', 'nim')],
            'angka'=> ['required'],
            'predikat'=> 'uppercase',
            'tahun_ajaran'=> 'required',
            'semester'=> 'required'
        ],[ 
            'id_matkul.required' => 'Kode Mata Kuliah wajib diisi',
            'id_matkul.uppercase' => 'Kode Mata Kuliah wajib kapital',
            'id_matkul.exists' => 'Kode Mata Kuliah tidak ditemukan',
            'nim.required' => 'NIM    wajib diisi',
            'nim.exists' => 'NIM tidak ditemukan',
            'angka.required' => 'Nilai wajib diisi',
            
            'predikat.uppercase' => 'Predikat wajib diisi dengan kapital',
            'tahun_ajaran.required' => 'Tahun Ajaran wajib diisi dengan kapital',
            'semester.required' => 'Semester wajib diisi ',
        ]);

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
        $angka = $request->input('angka');

        if ($angka >= 90) {
    $predikat = 'A';
        } else if ($angka >= 80) {
    $predikat = 'AB';
        } else if ($angka >= 70) {
    $predikat = 'B';
        } else if ($angka >= 60) {
    $predikat = 'BC';
        } else if ($angka >= 40) {
    $predikat = 'C';
        } else {
    $predikat = 'D';
        }
        $user = Auth::user();
        $data_update=[
            'nim' => $request->input('nim'),
            'id_matkul' => $request->input('id_matkul'),
            'angka' => $request->input('angka'),
            'predikat' => $predikat,
            'tahun_ajaran' => $request->input('tahun_ajaran'),
            'semester' => $request->input('semester')
        ];

        if ($validator->fails()) {
            return view('pages/nilai/edit_nilai',['user'=>$user, 'role'=>$role,'url_datanilai'=>$url_data]);
            $url_data ='active';

        }else{
            Nilai::where('no_nilai',$id)->update($data_update);
            $pesan = 'Berhasil diubah';
            // $data = Nilai::all();
            $data = Nilai::orderBy('id_matkul','asc')->paginate(5);
        $no = 1;
            return view("pages/dosen/table_nilaibydosen")->with(['data'=>$data,'no'=>$no,'user'=>$user, 'role'=>$role]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
