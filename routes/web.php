<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


//Auth routes     url --------------controller------,---metodo do controller
Route::get('/login', [AuthController::class, 'login']);
Route::post('/loginSubmit', [AuthController::class, 'loginSubmit']);
Route::get('/logout', [AuthController::class, 'logout']);
