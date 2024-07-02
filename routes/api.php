<?php

use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\DeliveryController;
use App\Http\Controllers\API\NotaController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\UserController;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('/orders', OrderController::class);
Route::apiResource('/customers', CustomerController::class);
Route::apiResource('/deliveries', DeliveryController::class);
Route::apiResource('/notas', NotaController::class);
Route::apiResource('/users', UserController::class);
