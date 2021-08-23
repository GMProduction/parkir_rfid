<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::get('/login', function () {
    return view('login');
});


Route::get('/admin', function () {
    return view('admin/dashboard');
});

Route::get('/admin/admin', function () {
    return view('admin/admin');
});

Route::get('/admin/petugas', function () {
    return view('admin/petugas');
});

Route::get('/admin/pelanggan', function () {
    return view('admin/pelanggan');
});

Route::get('/admin/topup', function () {
    return view('admin/topup');
});

Route::get('/admin/parkir', function () {
    return view('admin/parkir');
});

Route::get('/admin/laporan', function () {
    return view('admin/laporan');
});

Route::get('/admin/masterharga', function () {
    return view('admin/masterharga');
});


Route::get('/petugas', function () {
    return view('petugas/dashboard');
});

Route::get('/petugas/topup', function () {
    return view('petugas/topup');
});

Route::get('/petugas/parkir', function () {
    return view('petugas/parkir');
});

Route::get('/cetaklaporan/{date}', [LaporanController::class, 'cetakLaporan'])->name('cetakLaporan');

Route::post('/register',[AuthController::class,'register']);

Route::get('/barang', [BarangController::class, 'index']);
Route::post('/barang', [BarangController::class, 'createProduct']);
