<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pump\PumpController;
use App\Http\Controllers\sale\SaleController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\role\RolesController;
use App\Http\Controllers\shift\ShiftController;
use App\Http\Controllers\product\ProductController;
use App\Http\Controllers\customer\CustomerController;
use App\Http\Controllers\dashboard\DashBoardController;
use App\Http\Controllers\user\UserAllocationController;
use App\Http\Controllers\product\ProductPriceController;
use App\Http\Controllers\shift\CloseShiftController;
use App\Http\Controllers\pump\NozzleController;
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
    Route::resource('close_shift', CloseShiftController::class);
    Route::resource('role', RolesController::class);
    Route::resource('customer', CustomerController::class);
    Route::resource('pump', PumpController::class);
    Route::resource('product', ProductController::class);
    Route::resource('product_price', ProductPriceController::class);
    Route::resource('user_allocation', UserAllocationController::class);
    Route::resource('sale', SaleController::class);
    Route::post('users/update', [UserController::class, 'update_user'])->name('users.update');
    Route::post('sales/search', [SaleController::class, 'search'])->name('sales.search');
    Route::post('print/shift', [CloseShiftController::class, 'shift'])->name('print.shift');
    Route::resource('nozzle', NozzleController::class);
    Route::put('shifts/update/{shift_id}', [ShiftController::class, 'assignUser'])->name('shifts.update');
    Route::post('shifts/finalize_allocation/{shift_id}', [ShiftController::class, 'finalizeAllocation'])->name('shifts.finalize_allocation');
    Route::put('shifts/login/{shift_id}', [ShiftController::class, 'loginUser'])->name('shifts.login');
    Route::post('shifts/close_shift/{shift_id}', [ShiftController::class, 'closeShift'])->name('shifts.close_shift');
    Route::post('shifts/goods', [ShiftController::class, 'goods'])->name('shifts.goods');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
