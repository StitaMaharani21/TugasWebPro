<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    $portofolio = \App\Models\Portofolio::all();
    return view('welcome', compact('portofolio'));
})->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//portofolio
Route::get('/portofolio',[App\Http\Controllers\PortofolioController::class,'index'])->name('portofolio');
Route::get('portofolio/create',[App\Http\Controllers\PortofolioController::class,'create'])->name('portofolio.create');
Route::post('portofolio/create',[App\Http\Controllers\PortofolioController::class,'store'])->name('portofolio.store');
Route::get('portofolio/{id}/edit', [App\Http\Controllers\PortofolioController::class,'edit'])->name('portofolio.edit');
Route::put('portofolio/{id}', [App\Http\Controllers\PortofolioController::class,'update'])->name('portofolio.update');
Route::delete('/portofolio/{id}', [App\Http\Controllers\PortofolioController::class,'destroy'])->name('portofolio.destroy');

//category
Route::get('/category',[App\Http\Controllers\CategoryController::class,'index'])->name('category');
Route::get('category/create',[App\Http\Controllers\CategoryController::class,'create'])->name('category.create');
Route::post('category/create',[App\Http\Controllers\CategoryController::class,'store'])->name('category.store');
Route::get('category/{id}/edit', [App\Http\Controllers\CategoryController::class,'edit'])->name('category.edit');
Route::put('category/{id}', [App\Http\Controllers\CategoryController::class,'update'])->name('category.update');
Route::delete('/category/{id}', [App\Http\Controllers\CategoryController::class,'destroy'])->name('category.destroy');