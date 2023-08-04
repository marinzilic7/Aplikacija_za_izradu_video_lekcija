<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/* Registracija i prijava */

Route::post('/registerUser',[UserController::class,'registerUser']);
Route::post('/loginUser',[UserController::class,'loginUser']);
Route::get('/isLogged',[UserController::class,'isLogged']);
Route::post('/logoutUser',[UserController::class,'logoutUser']);

/* Kolegij */

Route::post('/dodajKolegij',[CourseController::class,'dodajKolegij']);
Route::get('/getKolegij',[CourseController::class,'getKolegij']);
Route::post('/deleteKolegij/{id}',[CourseController::class,'deleteKolegij']);
Route::get('/getNumberKolegij',[CourseController::class,'getNumberKolegij']);


/* Video */


Route::post('/dodajVideo',[LessonController::class,'dodajVideo']);
Route::get('/getLekcije',[LessonController::class,'getLekcije']);


Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '^(?!api).*$');
