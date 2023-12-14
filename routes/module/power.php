<?php
use App\Http\Controllers\PowerManagementController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth-middleware']], function () {
    Route::post('/power/{node}/{vmid}/start',[PowerManagementController::class, 'start']);
    Route::post('/power/{node}/{vmid}/reboot',[PowerManagementController::class, 'reboot']);
    Route::post('/power/{node}/{vmid}/shutdown',[PowerManagementController::class, 'shutdown']);
    Route::post('/power/{node}/{vmid}/force-shutdown',[PowerManagementController::class, 'force-shutdown']);
});
