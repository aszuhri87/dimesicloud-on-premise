<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MonitoringVMController;
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
    Route::get('virtual_machine', [MonitoringVMController::class, 'index']);
    Route::post('virtual_machine/dt', [MonitoringVMController::class, 'dt']);
    Route::get('dashboard', [DashboardController::class, 'index']);
    // Route::get('virtual_machine/{node}/{vmid}/graph', [MonitoringVMController::class, 'detail']);
    Route::get('virtual_machine-graph/{node}/{vmid}', [MonitoringVMController::class, 'detail']);

});
