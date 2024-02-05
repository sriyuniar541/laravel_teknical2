<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\CoaController;
use App\Http\Controllers\TransaksiController;

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

Route::get('/', function () {
    return view('welcome');
});


// kategori
Route::prefix('kategori')->group(function () {
    Route::get('/', [KategoriController::class, 'index']);
    Route::post('/', [KategoriController::class, 'store']);
    Route::put('/{id}', [KategoriController::class, 'update']);
    Route::delete('/{id}/delete', [KategoriController::class, 'destroy']);
});


// coa
Route::prefix('coa')->group(function () {
    Route::get('/', [CoaController::class, 'index']);
    Route::post('/', [CoaController::class, 'store']);
    Route::put('/{id}', [CoaController::class, 'update']);
    Route::delete('/{id}/delete', [CoaController::class, 'destroy']);
});

// transaksi
Route::prefix('transaksi')->group(function () {
    Route::get('/', [TransaksiController::class, 'index']);
    Route::post('/', [TransaksiController::class, 'store']);
    Route::put('/{id}', [TransaksiController::class, 'update']);
    Route::delete('/{id}/delete', [TransaksiController::class, 'destroy']);
});

// laporan
Route::get('/laporan', [TransaksiController::class, 'laporan']);


