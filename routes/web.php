<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManagementAlert;
use App\Http\Controllers\MonitoringVMController;
use App\Http\Controllers\NodeController;
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


Route::get('/', function () {
    return redirect('/login');
});


include base_path('routes/auth/route.php');
include base_path('routes/module/dashboard.php');
include base_path('routes/module/virtual_machine.php');
include base_path('routes/module/power.php');
include base_path('routes/module/alert.php');
include base_path('routes/module/node.php');
include base_path('routes/module/ceph.php');
include base_path('routes/module/object_storage.php');
include base_path('routes/module/management_access.php');



