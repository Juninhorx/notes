<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use Illuminate\Support\Facades\Route;


//Auth routes     url --------------controller------,---metodo do controller
// user not logged
Route::middleware([CheckIsNotLogged::class])->group(function() {

    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/loginSubmit', [AuthController::class, 'loginSubmit']);

});


// Todas as rotas que estão dentro dessa função, vão passar pelo middleware
// user logged
Route::middleware([CheckIsLogged::class])->group(function(){

    Route::get('/', [MainController::class, 'index']);
    Route::get('/newNote', [MainController::class, 'newNote']);
    Route::get('/logout', [AuthController::class, 'logout']);

});

