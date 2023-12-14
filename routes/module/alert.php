<?php
use App\Http\Controllers\ManagementAlert;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth-middleware']], function () {
    Route::get('/management-alert',[ManagementAlert::class, 'index']);
    Route::post('/management-alert',[ManagementAlert::class, 'store']);
    Route::post('/management-alert/dt_email',[ManagementAlert::class, 'dt_email']);
    Route::post('/management-alert/dt_telegram',[ManagementAlert::class, 'dt_telegram']);
    Route::delete('/management-alert/{id}',[ManagementAlert::class, 'delete']);
});
