<?php

use App\Http\Controllers\ClassController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;



Route::get('/', [CourseController::class, 'index2'])->name('home.home');

Route::get('/course', [CourseController::class, 'index'])->name('coach.course');
Route::post('/course/store', [CourseController::class, 'store'])->name('coach.store');


Route::get('/class', [ClassController::class, 'index'])->name('coach.class');
Route::post('/class/store', [ClassController::class, 'store'])->name('classes.store');
Route::delete('/classes/{class}', [ClassController::class, 'destroy'])->name('classes.destroy');



// Route pour afficher le formulaire de connexion
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');

// Route pour soumettre les informations de connexion
Route::post('login', [LoginController::class, 'login']);

// Route pour la déconnexion
Route::post('logout', [LoginController::class, 'logout'])->name('logout');


use App\Http\Controllers\Auth\RegisterController;

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login'])->name('login');
