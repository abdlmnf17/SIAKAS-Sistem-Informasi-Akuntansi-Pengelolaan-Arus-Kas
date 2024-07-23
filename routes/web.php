<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('user', App\Http\Controllers\UserController::class);
Route::resource('akun', App\Http\Controllers\AkunController::class);
Route::resource('kasmasuk', \App\Http\Controllers\KasMasukController::class);
Route::resource('kaskeluar', \App\Http\Controllers\KasKeluarController::class);
