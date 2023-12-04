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

include base_path('routes/auth/route.php');

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth-middleware']], function () {
    Route::get('virtual-machine', [MonitoringVMController::class, 'index']);
    Route::post('virtual-machine/dt', [MonitoringVMController::class, 'dt']);
    Route::get('dashboard', [DashboardController::class, 'index']);
    // Route::get('virtual-machine/{node}/{vmid}/graph', [MonitoringVMController::class, 'detail']);
    Route::get('virtual-machine-graph/{node}/{vmid}', [MonitoringVMController::class, 'detail']);
    Route::get('/resources/{virtual_machine_id}','DashboardController@resources');

    Route::post('/power/{node}/{vmid}/start',[PowerManagementController::class, 'start']);
    Route::post('/power/{node}/{vmid}/reboot',[PowerManagementController::class, 'reboot']);
    Route::post('/power/{node}/{vmid}/shutdown',[PowerManagementController::class, 'shutdown']);
    Route::post('/power/{node}/{vmid}/force-shutdown',[PowerManagementController::class, 'force-shutdown']);
    Route::get('/virtual-machine-current/{node}/{vmid}', [MonitoringVMController::class, 'current']);
    Route::get('/virtual-machine-os/{node}/{vmid}',[MonitoringVMController::class, 'os_info']);
    Route::get('/virtual-machine-network/{node}/{vmid}',[MonitoringVMController::class, 'network']);

    Route::get('/virtual-machine-series/{node}/{vmid}/{unit}/{type}',[MonitoringVMController::class, 'series']);

});
include base_path('routes/module/dashboard.php');
