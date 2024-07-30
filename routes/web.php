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

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/jurnal', [App\Http\Controllers\JurnalController::class, 'index'])->name('jurnal.index');
    Route::get('/bukubesar', [App\Http\Controllers\BukuBesarController::class, 'index'])->name('bukubesar.index');

    Route::delete('/bukubesar/{id}', [App\Http\Controllers\BukuBesarController::class, 'destroy'])->name('bukubesar.destroy');

    Route::get('/neraca', [App\Http\Controllers\NeracaController::class, 'index'])->name('neraca.index');

    Route::delete('/neraca/{id}', [App\Http\Controllers\NeracaController::class, 'destroy'])->name('neraca.destroy');


    Route::delete('/jurnal/{id}', [App\Http\Controllers\JurnalController::class, 'destroy'])->name('jurnal.destroy');
    Route::get('/labarugi', [App\Http\Controllers\LabaRugiController::class, 'index'])->name('labarugi.index');

    Route::post('/kasmasuk/reset', [App\Http\Controllers\KasMasukController::class, 'reset'])->name('kasmasuk.reset');

    Route::post('/kaskeluar/reset', [App\Http\Controllers\KasKeluarController::class, 'reset'])->name('kaskeluar.reset');

    Route::post('/bukubesar/reset', [App\Http\Controllers\BukuBesarController::class, 'reset'])->name('bukubesar.reset');

    Route::post('/jurnal/reset', [App\Http\Controllers\JurnalController::class, 'reset'])->name('jurnal.reset');
    Route::post('/neraca/reset', [App\Http\Controllers\NeracaController::class, 'reset'])->name('neraca.reset');

    Route::get('/laporan', [App\Http\Controllers\PDFController::class, 'index'])->name('pdf.index');
    Route::post('/laporan-kasmasuk-pdf', [App\Http\Controllers\PDFController::class, 'generateKasMasuk'])->name('pdf.kasmasuk');
    Route::post('/laporan-kaskeluar-pdf', [App\Http\Controllers\PDFController::class, 'generateKasKeluar'])->name('pdf.kaskeluar');
    Route::post('/laporan-jurnal-pdf', [App\Http\Controllers\PDFController::class, 'generateJurnal'])->name('pdf.jurnal');
    Route::post('/laporan-bukubesar-pdf', [App\Http\Controllers\PDFController::class, 'generateBukuBesar'])->name('pdf.bukubesar');
    Route::post('/laporan-neraca-pdf', [App\Http\Controllers\PDFController::class, 'generateNeraca'])->name('pdf.neraca');
    Route::post('/laporan-rugilaba-pdf', [App\Http\Controllers\PDFController::class, 'generateRugiLaba'])->name('pdf.rugilaba');
});





Route::middleware(['auth', 'ketua'])->group(function () {


    Route::resource('user', App\Http\Controllers\UserController::class);
    Route::resource('akun', App\Http\Controllers\AkunController::class);
    Route::resource('kasmasuk', \App\Http\Controllers\KasMasukController::class);
    Route::resource('kaskeluar', \App\Http\Controllers\KasKeluarController::class);


});
