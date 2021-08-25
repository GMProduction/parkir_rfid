<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HargaController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\LaporanSaldoController;
use App\Http\Controllers\Admin\ParkirController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\Admin\SaldoController;
use App\Http\Controllers\Admin\TopupController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\PetugasMiddleware;
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
    return redirect('/login');
});

Route::get('/login', function () {
    return view('login');
});

Route::post('/login', [AuthController::class,'login']);
Route::get('/logout', [AuthController::class,'logout']);



Route::prefix('/admin')->middleware(AdminMiddleware::class)->group(function (){

    Route::get('/', function () {
        return view('admin/dashboard');
    });

    Route::get('/data-admin', [AdminController::class, 'index']);
    Route::post('/data-admin', [AuthController::class, 'register']);
    Route::get('/data-admin/{id}/delete', [AdminController::class, 'delete']);

    Route::get('/petugas', [PetugasController::class,'index']);
    Route::post('/petugas', [AuthController::class, 'register']);
    Route::get('/petugas/{id}/delete', [PetugasController::class, 'delete']);


    Route::match(['get','post'],'/pelanggan', [PelangganController::class,'index']);
    Route::get('/pelanggan/{id}/delete', [PelangganController::class,'delete']);
    Route::get('/pelanggan/{id}/history', [PelangganController::class,'historySaldo']);

    Route::match(['get','post'],'/topup', [TopupController::class,'index']);
    Route::get('/topup/{id}/delete', [TopupController::class,'delete']);
    Route::get('/detail-pelanggan/{id}',[PelangganController::class,'getPelanggan']);

    Route::match(['post','get'],'/parkir', [ParkirController::class,'index']);
    Route::get('/parkir/get-pelanggan/{id}',[ParkirController::class,'getPelanggan']);
    Route::post('/parkir/{id}/update',[ParkirController::class,'update']);

    Route::get('/laporan', [LaporanController::class,'index']);


    Route::get('/laporan-saldo',[LaporanSaldoController::class,'index']);

    Route::match(['POST','GET'],'/masterharga', [HargaController::class, 'index']);

    Route::get('/cetaklaporan', [LaporanController::class, 'cetakLaporan'])->name('cetakLaporan');
    Route::get('/cetaklaporansaldo', [LaporanSaldoController::class, 'cetakLaporan']);

});

Route::prefix('/petugas')->middleware(PetugasMiddleware::class)->group(function (){
    Route::get('/', function () {
        return view('petugas/dashboard');
    });
    Route::match(['get','post'],'/topup', [\App\Http\Controllers\Petugas\TopupController::class,'index']);
    Route::get('/topup/{id}/delete', [\App\Http\Controllers\Petugas\TopupController::class,'delete']);
    Route::get('/detail-pelanggan/{id}',[PelangganController::class,'getPelanggan']);

    Route::match(['post','get'],'/parkir', [\App\Http\Controllers\Petugas\ParkirController::class,'index']);
    Route::get('/parkir/get-pelanggan/{id}',[\App\Http\Controllers\Petugas\ParkirController::class,'getPelanggan']);
    Route::post('/parkir/{id}/update',[\App\Http\Controllers\Petugas\ParkirController::class,'update']);
});


Route::post('/register',[AuthController::class,'register']);

