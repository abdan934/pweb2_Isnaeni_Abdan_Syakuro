<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserMhsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NilaibyDosenController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


//login
Route::get('/', [LoginController::class, 'index'])->middleware('isTamu');
Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/login', [LoginController::class, 'login'])->middleware('isTamu');
Route::post('/register', [LoginController::class, 'register'])->middleware('isTamu');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('isLogin');

// dosen
Route::resource('/dosen', DosenController::class)
->middleware(['isLogin','isAdmin']);
Route::resource('/nilaimahasiswa', NilaibyDosenController::class)
->middleware(['isLogin','isDosen']);

// mahasiswa
Route::resource('/mahasiswa', MahasiswaController::class)
->middleware(['isLogin','isAdmin']);

// matkul
Route::resource('/matakuliah', MatkulController::class)
->middleware(['isLogin','isAdmin']);

// nilai
Route::resource('/nilai', NilaiController::class)
->middleware(['isLogin','isAdmin']);
Route::resource('/nilai', NilaiController::class)
->middleware(['isLogin','isAdmin']);
// Route::get('/nilaimahasiswa', [NilaiController::class, 'create'])
// ->middleware(['isLogin','isDosen']);

// user
Route::resource('/datauser', UserController::class)
->middleware(['isLogin','isAdmin']);


Route::get('/nilaipersemester', [UserMhsController::class, 'index'])
->middleware(['isLogin','isMahasiswa']);
Route::post('/nilaipersemester/semester', [UserMhsController::class, 'Nilaipersemester'])
->middleware(['isLogin','isMahasiswa']);

Route::post('/importexcel',[UserController::class, 'importexcel'])->middleware(['isLogin','isAdmin']);

