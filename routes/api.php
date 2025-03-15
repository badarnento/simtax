<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\Master\MasterTERController;
use App\Http\Controllers\Master\MasterPegawaiController;
use App\Http\Controllers\Master\MasterPTKPController;
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

Route::post('/login', [ApiAuthController::class, 'login']);
Route::post('/logout', [ApiAuthController::class, 'logout'])->middleware('jwt.auth');
Route::get('/me', [ApiAuthController::class, 'me'])->middleware('jwt.auth');


Route::middleware(['jwt.auth'])->group(function () {
    Route::get('users/list', [UserController::class, 'getListing']);

    Route::get('tax/pph21/bulanan/list', [TaxPPh21Controller::class, 'getListing']);
    Route::get('master/pegawai/list', [MasterPegawaiController::class, 'getListing']);
    Route::get('master/ptkp/list', [MasterPTKPController::class, 'getListing']);
    Route::get('master/ter/list', [MasterTERController::class, 'getListing']);
});
