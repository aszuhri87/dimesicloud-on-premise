<?php

use App\Http\Controllers\AccessManagerController;
use App\Http\Controllers\CEPHController;
use App\Http\Controllers\ManagementAlert;
use App\Http\Controllers\ObjectStorageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['auth-middleware']], function () {
    Route::get('management-access', [AccessManagerController::class, 'index']);
    Route::post('management-access', [AccessManagerController::class, 'store']);
    Route::post('management-access/dt', [AccessManagerController::class, 'dt']);
    Route::delete('management-access/{id}', [AccessManagerController::class, 'destroy']);


    // Route::post('object-storage/{node}/{vmid}/{type}/dt', [ObjectStorageController::class, 'get']);
});
