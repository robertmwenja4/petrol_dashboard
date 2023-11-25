<?php

use App\Http\Controllers\cash\GiveCashController;
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
    Route::resource('give_cash', GiveCashController::class);
    Route::post('users/update', [UserController::class, 'update_user'])->name('users.update');
    Route::post('sales/search', [SaleController::class, 'search'])->name('sales.search');
    Route::post('print/shift', [CloseShiftController::class, 'shift'])->name('print.shift');
    Route::resource('nozzle', NozzleController::class);
    //sales
    Route::get('sale/get-product/{product_id}', [SaleController::class, 'findProduct'])->name('sale.get_product');
    Route::get('sale/get-customer/{customer_id}', [SaleController::class, 'findCustomer'])->name('sale.get_customer');
    //user shift management
    Route::put('shifts/update/{shift_id}', [ShiftController::class, 'assignUser'])->name('shifts.update');
    Route::post('shifts/finalize_allocation', [ShiftController::class, 'finalizeAllocation'])->name('shift.finalize_allocation');
    Route::put('shifts/login/{shift_id}', [ShiftController::class, 'loginUser'])->name('shifts.login');
    Route::post('shifts/close_shift', [ShiftController::class, 'closeShift'])->name('shift.close_shift');

    //admin shift
    Route::post('shifts/goods', [ShiftController::class, 'goods'])->name('shifts.goods');
    Route::post('give_cash/approve', [GiveCashController::class, 'approve'])->name('give_cash.approve');

    Route::get('print_invoice', [SaleController::class, 'fetchSale'])->name('print_invoice');
    Route::get('print_cash_receipt', [GiveCashController::class, 'fetchCashGiven'])->name('print_cash_receipt');
    Route::get('user_verify/{pass_key}', [UserController::class, 'verifyUser'])->name('user.verify');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
