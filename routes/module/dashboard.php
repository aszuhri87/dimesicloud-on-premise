<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MonitoringVMController;
use App\Http\Controllers\PowerManagementController;
use Illuminate\Support\Facades\Route;
use App\Library\Influx;
use InfluxDB2\Model\WritePrecision;
use InfluxDB2\Point;
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
});
