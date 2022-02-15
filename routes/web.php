<?php

use App\Http\Controllers\SiswaController;
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
// all => data nik, nama ,  last absen
Route::get('siswa', [SiswaController::class, 'show']);

//absen hari ini => nik nama
Route::get('absen', [SiswaController::class, 'absen']);
Route::get('todaydata', [SiswaController::class, 'todaydata']);
Route::get('alldata', [SiswaController::class, 'alldata']);
Route::get('homedata', [SiswaController::class, 'homedata']);
