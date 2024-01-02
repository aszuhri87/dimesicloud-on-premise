<?php

use App\Http\Controllers\CEPHController;
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
    Route::get('object-storage', [ObjectStorageController::class, 'index']);
    Route::post('object-storage/dt', [ObjectStorageController::class, 'dt']);
    Route::post('object-storage/{bucket}/dt', [ObjectStorageController::class, 'detail']);
    Route::get('object-storage/{bucket}/detail', [ObjectStorageController::class, 'detail_list']);
});
