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

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/piloto/{recurso}', [\App\Http\Controllers\RecursoController::class, 'index'])->name('recurso');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* graficos */
Route::get('/chartUser', [App\Http\Controllers\ChartController::class, 'chartUser']);
Route::get('/chartPCM', [App\Http\Controllers\ChartController::class, 'chartPCM']);
Route::get('/chartFaturado', [App\Http\Controllers\ChartController::class, 'chartFaturado']);
Route::get('/chartMensal', [App\Http\Controllers\ChartController::class, 'chartMensal']);
Route::get('/chartMeta', [App\Http\Controllers\ChartController::class, 'chartMeta']);
