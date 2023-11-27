<?php
use App\Http\Controllers\AuthController;


Route::group(['middleware' => ['guest-middleware']], function () {

    Route::get('/', function () {
        // return view('layouts.base');
        return redirect('/login');
    });
    // Route::get('/register', function(){
    // 	return view('register');
    // });

    Route::get('login', [AuthController::class, 'index']);
    Route::post('login', [AuthController::class, 'login']);
    Route::get('logout', [AuthController::class, 'logout']);

});
