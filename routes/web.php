<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('tanamans', App\Http\Livewire\TanamanCrud::class)->name('tanamans');
    Route::get('kolams', App\Http\Livewire\KolamCrud::class)->name('kolams');
    Route::get('ternaks', App\Http\Livewire\TernakCrud::class)->name('ternaks');
    Route::get('pakans', App\Http\Livewire\PakanCrud::class)->name('pakans');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
}); 

// Route::resource('tanaman', App\Http\Controllers\API\TanamanController::class);
// Route::resource('kolam', App\Http\Controllers\API\KolamController::class);
// Route::resource('ternak', App\Http\Controllers\API\TernakController::class);
// Route::resource('pakan', App\Http\Controllers\API\PakanController::class);

// Route::get('tanaman', [App\Http\Controllers\API\TanamanController::class, 'index'])->name('tanaman');
// Route::get('kolam', [App\Http\Controllers\API\KolamController::class, 'index'])->name('kolam');
// Route::get('ternak', [App\Http\Controllers\API\TernakController::class, 'index'])->name('ternak');
// Route::get('pakan', [App\Http\Controllers\API\PakanController::class, 'index'])->name('pakan');

