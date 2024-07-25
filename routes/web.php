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
Route::get('/jurnal', [App\Http\Controllers\JurnalController::class, 'index'])->name('jurnal.index');
Route::get('/bukubesar', [App\Http\Controllers\BukuBesarController::class, 'index'])->name('bukubesar.index');

Route::delete('/bukubesar/{id}', [App\Http\Controllers\BukuBesarController::class, 'destroy'])->name('bukubesar.destroy');

Route::get('/neraca', [App\Http\Controllers\NeracaController::class, 'index'])->name('neraca.index');

Route::delete('/neraca/{id}', [App\Http\Controllers\NeracaController::class, 'destroy'])->name('neraca.destroy');


Route::delete('/jurnal/{id}', [App\Http\Controllers\JurnalController::class, 'destroy'])->name('jurnal.destroy');
