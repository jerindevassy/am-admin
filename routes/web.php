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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');


Route::get('/agent', [App\Http\Controllers\HomeController::class, 'agent'])->name('agent');
Route::get('/agentlist', [App\Http\Controllers\HomeController::class, 'agentlist'])->name('agentlist');
Route::post('/agentcreate', [App\Http\Controllers\HomeController::class, 'agentcreate'])->name('agentcreate');


