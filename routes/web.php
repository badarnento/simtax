<?php

use App\Models\TaxLine;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\TaxLineController;
use App\Http\Controllers\TaxTypeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TaxEntityController;
use App\Http\Controllers\FinancialAccountController;

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
    return view('layouts/master');
});


Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Semua halaman ini hanya bisa diakses jika sudah login
Route::middleware(['jwt.session'])->group(function () {
    
    Route::get('/home', [PageController::class, 'home'])->name('home');
    Route::get('/about', [PageController::class, 'about'])->name('about');
});