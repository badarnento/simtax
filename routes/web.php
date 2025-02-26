<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

use App\Http\Controllers\VendorController;
use App\Http\Controllers\TaxTypeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TaxEntityController;
use App\Http\Controllers\FinancialAccountController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaxLineController;
use App\Models\TaxLine;

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

Route::prefix('tax')->group(function () {
    Route::get('pph-21/list', [TaxLineController::class, 'getListing'])->name('tax_line.listing');
    Route::resource('pph-21', TaxLineController::class);
});

/* Master  */
Route::prefix('master')->group(function () {

    /* Karyawan  */
    Route::get('employees/list', [EmployeeController::class, 'getListing'])->name('employees.listing');
    Route::resource('employees', EmployeeController::class);

    /* Jenis Pajak  */
    Route::get('tax-types/list', [TaxTypeController::class, 'getListing'])->name('tax-types.listing');
    Route::resource('tax-types', TaxTypeController::class);

    /* Vendor  */
    Route::get('vendor/list', [VendorController::class, 'getListing'])->name('vendor.listing');
    Route::resource('vendor', VendorController::class);
});

/* Jenis Pajak  */
Route::prefix('admin')->group(function () {

    /* Users  */
    Route::get('users/list', [UserController::class, 'getListing'])->name('users.listing');
    Route::resource('users', UserController::class);

    /* Roles  */
    Route::get('roles/list', [RoleController::class, 'getListing'])->name('roles.listing');
    Route::resource('roles', RoleController::class);
});
