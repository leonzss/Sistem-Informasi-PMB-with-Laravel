<?php

use App\Http\Controllers\MhsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });



Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [MhsController::class, 'index'])->name('index');
    Route::get('/mhs/print_pdf', [MhsController::class, 'print_pdf'])->name('print_pdf');

    Route::get('/mhs/create', [MhsController::class, 'create'])->name('create');
    Route::post('/mhs/store', [MhsController::class, 'store'])->name('store');
    Route::get('/mhs/{id}/edit', [MhsController::class, 'edit'])->name('edit');
    Route::put('/mhs/{id}/update', [MhsController::class, 'update'])->name('update');
    Route::get('/mhs/{id}/destroy', [MhsController::class, 'destroy'])->name('destroy');

    Route::get('/exportmhs', [MhsController::class, 'mhsexport'])->name('mhsexport');
    Route::post('/importmhs', [MhsController::class, 'mhsimport'])->name('mhsimport');
    
    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // Route::resource('/mhs', MhsController::class);
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');