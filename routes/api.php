<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\PurchaseController;

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

//User routes
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('users/me', [AuthController::class, 'me']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->put('changePassword', [AuthController::class, 'changePassword']);

//Book routes
Route::get('books', [BookController::class, 'index']);
Route::get('genres', [BookController::class, 'genresIndex']);

//Purchase routes
Route::get('purchases', [PurchaseController::class, 'purchases']);