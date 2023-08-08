<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\PenyakitController;
use App\Http\Controllers\KasusController;
use App\Http\Controllers\DiagnosaController;

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

Route::resource('user', UserController::class)->middleware('admin');
Route::resource('gejala', GejalaController::class)->middleware('auth');
Route::resource('penyakit', PenyakitController::class)->middleware('auth');
Route::resource('kasus', KasusController::class)->middleware('auth');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [LoginController::class, 'register'])->name('register')->middleware('guest');
Route::post('auth/register', [LoginController::class, 'registerPost'])->name('register.post')->middleware('guest');
Route::get('login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('auth/login', [LoginController::class, 'loginPost'])->name('login.post')->middleware('guest');


Route::get('home', [DiagnosaController::class, 'index'])->name('home');
Route::get('informasi', [DiagnosaController::class, 'informasi'])->name('informasi')->middleware('guest');

Route::get('konsultasi', [DiagnosaController::class, 'konsultasi'])->name('konsultasi');
Route::post('konsul', [DiagnosaController::class, 'konsultasiPost'])->name('konsul.post');

Route::get('/', function () {
    return redirect('home');
});

Route::get('/welcome', function () {
    return view('welcome');
});
