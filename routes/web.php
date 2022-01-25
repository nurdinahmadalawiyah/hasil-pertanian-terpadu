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
    Route::get('about', App\Http\Livewire\About::class)->name('about');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
}); 