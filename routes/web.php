<?php

use App\Http\Controllers\ClassController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Models\Lesson;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [CourseController::class, 'index2'])->name('home.home');
Route::get('/course/lessons/{course}', [LessonController::class, 'lessonView'])->name('course.lessons');


Route::get('/course', [CourseController::class, 'index'])->name('coach.course');
Route::post('/course/store', [CourseController::class, 'store'])->name('coach.store');


Route::get('/courses/lessons/{course}', [LessonController::class, 'index'])->name('lessons.create');
Route::post('/courses/lessons/{course}', [LessonController::class, 'store'])->name('lessons.store');
Route::delete('/lesson/{lesson}', [LessonController::class, 'destroy'])->name('lesson.destroy');


Route::get('/coach/{course}/lessons', [LessonController::class, 'index'])->name('coach.lesson');


Route::get('/class', [ClassController::class, 'index'])->name('coach.class');
Route::post('/class/store', [ClassController::class, 'store'])->name('classes.store');
Route::delete('/classes/{class}', [ClassController::class, 'destroy'])->name('classes.destroy');
Route::get('/class/courses/{class}', [ClassController::class, 'viewCourses'])->name('class.courses');
Route::get('/class/classes/{class}', [ClassController::class, 'viewClasses'])->name('class.classes');

Route::post('/classes/assign-student', [ClassController::class, 'assignStudent'])->name('classes.assign-student');
Route::post('/class/assign-student', [ClassController::class, 'assignStudent'])->name('class.assignStudent');
Route::post('/classes/{class}/enroll', [ClassController::class, 'enroll'])->name('classes.enroll');


// Route pour afficher le formulaire de connexion
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');

// Route pour soumettre les informations de connexion
Route::post('login', [LoginController::class, 'login']);

// Route pour la déconnexion
Route::post('logout', [LoginController::class, 'logout'])->name('logout');




Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login'])->name('login');
