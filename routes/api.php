<?php

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

Route::post('/login', 'App\Http\Controllers\API\AuthController@login')->name('login')->middleware(['throttle:10']);
Route::post('/logout', 'App\Http\Controllers\API\AuthController@logout')->middleware('auth:sanctum')->name('logout');

Route::middleware('auth:sanctum')->group(function (){
    Route::resource('/companies', App\Http\Controllers\API\CompanyController::class, [
        'only' => ['index']
    ]);
    Route::resource('/employees', App\Http\Controllers\API\EmployeeController::class, [
        'only' => ['index']
    ]);
});