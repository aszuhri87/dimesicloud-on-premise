<?php
use App\Http\Controllers\AuthController;


Route::group(['middleware' => ['guest-middleware']], function () {

    Route::get('/', function () {
        // return view('layouts.base');
        return redirect('/login');
    });

    Route::get('login', [AuthController::class, 'index']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::group(['middleware' => ['auth-middleware']], function () {
    Route::get('logout', [AuthController::class, 'logout']);
});
