<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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

Route::resource('user', \App\Http\Controllers\UserController::class);

Route::resource('gejalapenyakit/gejala', \App\Http\Controllers\GejalaController::class);

Route::resource('gejalapenyakit/penyakit', \App\Http\Controllers\PenyakitController::class);

Route::resource('gejalapenyakit', \App\Http\Controllers\GejalaPenyakitController::class);

Route::resource('dashboard', \App\Http\Controllers\UserChekingPenyakit::class);

Route::get('register', [LoginController::class, 'register'])->name('register');
Route::post('auth/register', [LoginController::class, 'registerPost'])->name('register.post');
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('auth/login', [LoginController::class, 'loginPost'])->name('login.post');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('login');
});


Route::get('/forgot', function () {
    return view('forgot');
});

Route::get('/home', function () {
    return view('page/main');
});

Route::get('/welcome', function () {
    return view('welcome');
});
