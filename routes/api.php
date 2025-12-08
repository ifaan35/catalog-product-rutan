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

// Indonesia Area API Routes (without authentication)
use App\Http\Controllers\IndonesiaAreaController;

Route::get('/indonesia/provinces', [IndonesiaAreaController::class, 'provinces']);
Route::get('/indonesia/regencies/{provinceId}', [IndonesiaAreaController::class, 'regencies']);
Route::get('/indonesia/districts/{regencyId}', [IndonesiaAreaController::class, 'districts']);
Route::get('/indonesia/villages/{districtId}', [IndonesiaAreaController::class, 'villages']);
