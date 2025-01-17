<?php

use App\Http\Controllers\DashboardController;
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
    Route::get('dashboard/statistic-resources', [DashboardController::class, 'statistic_resources']);
    Route::get('dashboard/disk-wearout', [DashboardController::class, 'top_disk_weareout']);
    Route::get('dashboard/index', [DashboardController::class, 'index']);
    Route::get('dashboard', [DashboardController::class, 'index']);

});
