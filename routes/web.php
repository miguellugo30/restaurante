<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MesasController;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['namespace' => 'App\Http\Controllers', 'prefix' => 'home', 'middleware' => 'auth'], function() {
    Route::resource('mesas','MesasController');
    Route::resource('alimentos','AlimentosController');
    Route::resource('bebidas','BebidasController');
    Route::resource('cuentas','CuentasController');
    Route::resource('meseros','MeserosController');
    Route::resource('cocina','CocinaController');
});
