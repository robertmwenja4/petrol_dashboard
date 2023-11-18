<?php

use App\Http\Controllers\apis\PetrolConsumptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'oryx'], function () {
    //fetch pump with products
    Route::get('/fetchPumps', [PetrolConsumptionController::class, 'fetchPumps'])->name('api.fetchPumps');
    //fetch customers who are of type credit
    Route::get('/fetchCreditCustomers', [PetrolConsumptionController::class, 'fetchCreditCustomers'])->name('api.fetchCreditCustomers');
    //record sales
    Route::post('/recordSale', [PetrolConsumptionController::class, 'recordSale'])->name('api.recordSale');
});
