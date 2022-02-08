<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PersyaratanController;
use App\Http\Controllers\PenyelenggaraController;

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


Route::get('/', [AuthController::class, 'index'])->middleware('guest')->name('auth');
Route::post('/auth', [AuthController::class, 'ajax_login'])->name('auth.ajax_login');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.ajax_logout');


Route::group(['middleware' => 'auth'], function () {
    route::get('/dashboard', [DashboardController::class, 'index']);
    route::resource('/penyelenggara', PenyelenggaraController::class);
    route::resource('/layanan', LayananController::class)->except('create', 'show', 'update');
    route::resource('/persyaratan', PersyaratanController::class)->except('create', 'show', 'update');
});
