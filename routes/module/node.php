<?php
use App\Http\Controllers\NodeController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth-middleware']], function () {
    Route::get('/node',[NodeController::class, 'index']);
    Route::post('/node/dt',[NodeController::class, 'dt']);
    Route::get('/node-detail/{node}',[NodeController::class, 'detail']);
    Route::get('/node-detail/{node}/profile',[NodeController::class, 'profile']);
    Route::get('/node-detail/{node}/{unit}/{type}/resources',[NodeController::class, 'resource']);
    Route::post('/node-detail/{node}/list-disk',[NodeController::class, 'list_disk']);
});
