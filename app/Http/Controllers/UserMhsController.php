<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\NilaiController;
use App\Models\Matkul;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Nilai;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserMhsController extends Controller
{
    //
    public function index()
    {
        //
        // $data = Nilai::all();
        // $data = Nilai::join('table_matkul', 'table_nilai.id_matkul', '=', 'table_matkul.id_matkul')
        $user = Auth::user();
        $data = DB::table('table_nilai')
        ->join('table_matkul', 'table_matkul.id_matkul', '=', 'table_nilai.id_matkul')
        ->select('table_matkul.id_matkul', 'table_matkul.nama_matkul', 'table_nilai.predikat')
        ->where('table_nilai.nim', '=', $user->username)
        ->get();
        $url_nilaipersem = 'active';
        $usermhs = Mahasiswa::where('nim', $user->username)->first();
        $userdosen = Dosen::where('nidn', $user->username)->first();
        if (!is_null($usermhs)) {
            $role = 'mahasiswa';
        } elseif (!is_null($userdosen)) {
            $role = 'dosen';
        } else {
            $role = 'admin';
        }

            return view("pages/nilai/nilai_persemester")->with(['data'=>$data,'user'=>$user, 'role'=>$role,'url_nilaipersem'=>$url_nilaipersem]);
    }

    public function Nilaipersemester(Request $request)
    {
    $tahunAjaran = $request->input('tahun_ajaran');
    $semester = $request->input('semester');
    $user = Auth::user();
    $url_nilaipersem = 'active';
        $usermhs = Mahasiswa::where('nim', $user->username)->first();
        $userdosen = Dosen::where('nidn', $user->username)->first();
        if (!is_null($usermhs)) {
            $role = 'mahasiswa';
        } elseif (!is_null($userdosen)) {
            $role = 'dosen';
        } else {
            $role = 'admin';
        }

    // Query untuk mengambil data mahasiswa
    $data = DB::table('table_nilai')
    ->join('table_matkul', 'table_matkul.id_matkul', '=', 'table_nilai.id_matkul')
    ->select('table_matkul.id_matkul', 'table_matkul.nama_matkul', 'table_nilai.predikat')
    ->where('table_nilai.tahun_ajaran', $tahunAjaran)
    ->where('table_nilai.semester', $semester)
    ->where('table_nilai.nim', '=', $user->username)
    ->get();
    Session::flash('tahun_ajaran',$request->input('tahun_ajaran'));
    Session::flash('semester',$request->input('semester'));

    // Mengirim data ke view untuk ditampilkan dalam tabel
    return view('pages/nilai/nilai_persemester')->with(['data'=>$data,'user'=>$user, 'role'=>$role,'url_nilaipersem'=>$url_nilaipersem]);
    }
}
