<?php

use App\Http\Controllers\ClassController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use Illuminate\Support\Facades\Route;



Route::get('/', [CourseController::class, 'index2'])->name('home.home');

Route::get('/course', [CourseController::class, 'index'])->name('coach.course');
Route::post('/course/store', [CourseController::class, 'store'])->name('coach.store');


Route::get('/courses/lessons/{course}', [LessonController::class, 'index'])->name('lessons.create');
Route::post('/courses/lessons/{course}', [LessonController::class, 'store'])->name('lessons.store');
Route::delete('/lesson/{lesson}', [LessonController::class, 'destroy'])->name('lesson.destroy');


Route::get('/class', [ClassController::class, 'index'])->name('coach.class');
Route::post('/class/store', [ClassController::class, 'store'])->name('classes.store');
Route::delete('/classes/{class}', [ClassController::class, 'destroy'])->name('classes.destroy');
Route::get('/class/courses/{class}', [ClassController::class, 'viewCourses'])->name('class.courses');

