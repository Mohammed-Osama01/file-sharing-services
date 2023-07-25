<?php

use App\Http\Controllers\FileController;
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

Route::prefix('/files')->name('files.')->group(function(){
    Route::get('/', [FileController::class, 'index'])->name('index');
    Route::get('/create', [FileController::class, 'create'])->name('create');
    Route::post('/', [FileController::class, 'store'])->name('store');
    Route::delete('/{file}', [FileController::class, 'destroy'])->name('destroy');
    Route::get('/download/{id}', [FileController::class, 'download'])->name('download');
});

