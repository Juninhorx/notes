<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use Illuminate\Support\Facades\Route;


//Auth routes     url --------------controller------,---metodo do controller
// user not logged
Route::middleware([CheckIsNotLogged::class])->group(function() {

    Route::get('/singIn', [UserController::class, 'singIn'])->name('singIn');
    Route::post('/singInSubmit', [UserController::class, 'singInSubmit'])->name('singInSubmit');


    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/loginSubmit', [AuthController::class, 'loginSubmit']);

});


// Todas as rotas que estão dentro dessa função, vão passar pelo middleware
// user logged
Route::middleware([CheckIsLogged::class])->group(function(){

    Route::get('/', [MainController::class, 'index'])->name('home');
    Route::get('/newNote', [MainController::class, 'newNote'])->name('new');
    Route::post('/newNoteSubmit', [MainController::class, 'newNoteSubmit'])->name('newNoteSubmit');

    //edit note
    Route::get('/editNote/{id}', [MainController::class, 'editNote'])->name('edit');
    Route::post('/editNoteSubmit', [MainController::class, 'editNoteSubmit'])->name('editNoteSubmit');


    //delete note
    Route::get('/deleteNote/{id}', [MainController::class, 'deleteNote'])->name('delete');
    Route::get('/deleteConfirm/{id}', [MainController::class, 'deleteConfirm'])->name('deleteConfirm');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

});

