<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\DashBoardController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\user\UserAllocationController;
use App\Http\Controllers\shift\ShiftController;
use App\Http\Controllers\role\RolesController;
use App\Http\Controllers\customer\CustomerController;
use App\Http\Controllers\pump\PumpController;
use App\Http\Controllers\product\ProductController;
use App\Http\Controllers\product\ProductPriceController;
use App\Http\Controllers\sale\SaleController;
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
Route::middleware(['auth'])->group(function () {
    
    Route::resource('dashboard', DashBoardController::class);
    Route::resource('user', UserController::class);
    Route::resource('shift', ShiftController::class);
    Route::resource('role', RolesController::class);
    Route::resource('customer', CustomerController::class);
    Route::resource('pump', PumpController::class);
    Route::resource('product', ProductController::class);
    Route::resource('product_price', ProductPriceController::class);
    Route::resource('user_allocation', UserAllocationController::class);
    Route::resource('sale', SaleController::class);
    Route::post('users/update', [UserController::class, 'update_user'])->name('users.update');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
