<?php

use App\Http\Controllers\API\AuthAPIController;
use App\Http\Controllers\API\MonitoringAPIController;
use App\Http\Controllers\API\PemasukanPengeluaranAPIController;
use App\Http\Controllers\API\ProfileAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthAPIController::class, 'login']);
Route::post('/logout', [AuthAPIController::class, 'logout']);
Route::post('/register', [AuthAPIController::class, 'register']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum', 'user-access:petugas'])->group(function () {
    Route::get('/lihat-lokasi', [PemasukanPengeluaranAPIController::class, 'lihatlokasi']);
    Route::get('/lihat-riwayat-tukar-poin', [PemasukanPengeluaranAPIController::class, 'lihatriwayattukarpoin']);
    Route::post('/pemasukan-sampah/{id}', [PemasukanPengeluaranAPIController::class, 'pemasukansampah']);
    Route::post('/tukar-poin', [PemasukanPengeluaranAPIController::class, 'tukarpoin']);
    Route::get('/profile', [ProfileAPIController::class, 'profilepetugas']);
});
Route::middleware(['auth:sanctum', 'user-access:nasabah'])->group(function () {
    Route::get('/lihat-poin', [MonitoringAPIController::class, 'lihatpoin']);
    Route::get('/lihat-riwayat-tukar-poin', [MonitoringAPIController::class, 'lihatriwayattukarpoin']);
    Route::get('/kontribusi-sampah', [MonitoringAPIController::class, 'kontribusisampah']);
    Route::get('/pemasukan-sampah', [MonitoringAPIController::class, 'pemasukansampah']);
    Route::get('/profile', [ProfileAPIController::class, 'profilenasabah']);
});
