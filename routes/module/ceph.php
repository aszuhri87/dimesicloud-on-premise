<?php

use App\Http\Controllers\CEPHController;
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
    Route::get('ceph', [CEPHController::class, 'index']);
    Route::get('ceph/data', [CEPHController::class, 'get']);
});
