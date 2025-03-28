<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\Master\MasterTERController;
use App\Http\Controllers\Master\MasterPegawaiController;
use App\Http\Controllers\Master\MasterPTKPController;
use App\Http\Controllers\Master\MasterKodeObjekPPH21Controller;
use App\Http\Controllers\Master\MasterPemotongController;
use App\Http\Controllers\TaxPPh21Controller;

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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::prefix('v1.0')->group(function () {

    Route::post('/login', [ApiAuthController::class, 'login']);
    Route::post('/logout', [ApiAuthController::class, 'logout'])->middleware('jwt.auth');
    Route::get('/me', [ApiAuthController::class, 'me'])->middleware('jwt.auth');


    Route::middleware(['jwt.auth'])->group(function () {
        Route::get('users/list', [UserController::class, 'getListing']);

        Route::prefix('tax/pph21')->group(function () {

            Route::get('get-tarif', [TaxPPh21Controller::class, 'getTarif']);

            Route::get('bulanan/list', [TaxPPh21Controller::class, 'getListing']);
            Route::apiResource('bulanan', TaxPPh21Controller::class);
        });

        Route::prefix('master')->group(function () {

            Route::get('pegawai/list', [MasterPegawaiController::class, 'getListing']);
            Route::get('ptkp/list', [MasterPTKPController::class, 'getListing']);
            Route::get('ter/list', [MasterTERController::class, 'getListing']);
            Route::get('pemotong/list', [MasterPemotongController::class, 'getListing']);
            Route::get('kode-objek-pph21/list', [MasterKodeObjekPPH21Controller::class, 'getListing']);

            Route::apiResource('pegawai', MasterPegawaiController::class);
            Route::apiResource('ptkp', MasterPTKPController::class);
            Route::apiResource('ter', MasterTERController::class);
            Route::apiResource('pemotong', MasterPemotongController::class);
            Route::apiResource('kode-objek-pph21', MasterKodeObjekPPH21Controller::class);
        });
    });
});
