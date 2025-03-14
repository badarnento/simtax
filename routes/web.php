<?php

use App\Models\TaxLine;
use Illuminate\Http\Request;

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
Route::get('/login', function () {
    return view('auth.login');
})->name('login');


Route::get('/', function () {
    return view('layouts/master');
});


$pages = [
    'home' => 'pages.home',
        'about' => 'pages.about',
        'admin/users' => 'pages.admin.users.listing' // Otomatis gunakan "listing"
];



Route::get('/{any?}', function (Request $request, $any = null) use($pages) {
    $pagesConfig = $pages; // Ambil daftar halaman dari config
    $page = $any ?: 'home'; // Default ke 'home' jika $any kosong

    // Cek apakah halaman ada dalam config
    if (!array_key_exists($page, $pagesConfig)) {
        abort(404);
    }

    $viewPath = $pagesConfig[$page]; // Ambil path dari config

    if ($request->ajax()) {
        return view($viewPath);
    }

    return view('spa', ['page' => $page]);
})->where('any', implode("|", array_map('preg_quote', array_keys($pages))));