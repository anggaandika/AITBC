<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\PenyakitController;
use App\Http\Controllers\GejalaPenyakitController;
use App\Http\Controllers\UserChekingPenyakit;

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

Route::resource('user', UserController::class)->middleware('auth');
Route::resource('gejalapenyakit/gejala', GejalaController::class)->middleware('auth');
Route::resource('gejalapenyakit/penyakit', PenyakitController::class)->middleware('auth');
Route::resource('gejalapenyakit', GejalaPenyakitController::class)->middleware('auth');

Route::get('register', [LoginController::class, 'register'])->name('register')->middleware('guest');
Route::post('auth/register', [LoginController::class, 'registerPost'])->name('register.post')->middleware('guest');
Route::get('login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('auth/login', [LoginController::class, 'loginPost'])->name('login.post')->middleware('guest');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('home', [UserChekingPenyakit::class, 'index'])->name('home');
Route::get('home/konsultasi', [UserChekingPenyakit::class, 'konsultasi'])->name('konsultasi');
Route::resource('home/kontak', UserChekingPenyakit::class);

Route::get('/', function () {
    return redirect('home');
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
