<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});


Route::get('/login', [\App\Http\Controllers\UserController::class, 'login'])->name('users.login');
Route::post('/login', [\App\Http\Controllers\UserController::class, 'postlogin'])->name('users.login');
Route::group(['middleware'=>['auth']],function(){
Route::get('/logout', [\App\Http\Controllers\UserController::class, 'logout'])->name('users.logout');

//route resource
Route::resource('/users', \App\Http\Controllers\UserController::class);




Route::get('/users/change-password/{id}', [\App\Http\Controllers\UserController::class, 'changePassword'])->name('users.change-password');
Route::put('/users/change-password/{id}', [\App\Http\Controllers\UserController::class, 'updatePassword'])->name('users.change-password');
});