<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\DashBoardController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\shift\ShiftController;
use App\Http\Controllers\role\RolesController;
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
Route::resource('dashboard', DashBoardController::class);
Route::resource('user', UserController::class);
Route::resource('shift', ShiftController::class);
Route::resource('role', RolesController::class);
Route::post('users/update', [UserController::class, 'update_user'])->name('users.update');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
