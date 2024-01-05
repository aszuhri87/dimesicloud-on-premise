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
    Route::post('object-storage/create-bucket', [ObjectStorageController::class, 'create']);
    Route::get('object-storage/{bucket}/delete', [ObjectStorageController::class, 'delete']);
    Route::post('object-storage/{bucket}/create-object', [ObjectStorageController::class, 'create_object']);
    Route::post('object-storage/{bucket}/{key}/privacy-object', [ObjectStorageController::class, 'privacy_object']);
    Route::get('object-storage/{bucket}/{key}/delete-object', [ObjectStorageController::class, 'delete_object']);
    Route::get('object-storage/{bucket}/{key}/share-object', [ObjectStorageController::class, 'share_object']);
    Route::get('object-storage/{bucket}/{key}/show-object', [ObjectStorageController::class, 'show_object']);
    Route::get('object-storage/{bucket}/{key}/delete-all-object', [ObjectStorageController::class, 'delete_all_object']);
    Route::get('object-storage/{bucket}/delete-all-bucket', [ObjectStorageController::class, 'delete_all_bucket']);

});
