<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    'home'        => 'pages.home',
    'about'       => 'pages.about',
    'product'     => 'pages.product',

    'master/pegawai' => 'pages.master.pegawai',



    'admin/users' => 'pages.admin.users',
];

Route::get('/{any?}', function (Request $request, $any = null) use ($pages) {
    $pagesConfig = $pages;
    $page = $any ?: 'home';

    if (!array_key_exists($page, $pagesConfig)) {
        abort(404);
    }

    $viewPath = $pagesConfig[$page];

    if ($request->ajax()) {
        return view($viewPath);
    }

    return view('spa', ['page' => $page]);
})->where('any', implode("|", array_map('preg_quote', array_keys($pages))));
