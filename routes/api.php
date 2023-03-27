<?php

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

use App\Http\Controllers\Api\CRUDProductController;
Route::controller(CRUDProductController::class)->group( function() {
    Route::get('/products','list');
    Route::post('/products/create','create');
    Route::post('/products/{id}/update','update');
    Route::get('/products/{id}/delete','delete');
});

use App\Http\Controllers\Api\TransaksiAPIController;
Route::controller(TransaksiAPIController::class)->group( function() {
    Route::post('/transaction','transaksi');
});