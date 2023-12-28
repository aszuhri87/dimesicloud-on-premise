<?php
use App\Http\Controllers\MonitoringVMController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth-middleware']], function () {
    Route::get('virtual-machine', [MonitoringVMController::class, 'index']);
    Route::post('virtual-machine/dt', [MonitoringVMController::class, 'dt']);
    Route::get('/resources/{virtual_machine_id}','DashboardController@resources');

    Route::get('virtual-machine-graph/{node}/{vmid}', [MonitoringVMController::class, 'detail']);
    Route::get('/virtual-machine-current/{node}/{vmid}/{type}', [MonitoringVMController::class, 'current']);
    Route::get('/virtual-machine-os/{node}/{vmid}/{type}',[MonitoringVMController::class, 'os_info']);
    Route::get('/virtual-machine-network/{node}/{vmid}/{type}',[MonitoringVMController::class, 'network']);
    Route::get('/virtual-machine-series/{node}/{vmid}/{unit}/{type}/{node_type}',[MonitoringVMController::class, 'series']);
    Route::get('/virtual-machine-series-disk/{node}/{vmid}/{unit}/{type}/{node_type}',[MonitoringVMController::class, 'series_disk']);
    Route::post('/virtual-machine-users/{node}/{vmid}/{type}/dt', [MonitoringVMController::class, 'user_list']);

});
