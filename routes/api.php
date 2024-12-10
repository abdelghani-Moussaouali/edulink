<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


//testing 

Route::get('test',[UserController::class,'test']);


// public route for students 
Route::post('user/register',[AuthController::class,'register']);
Route::get('user/',[UserController::class,'index']);
Route::get('user/students',[StudentController::class,'index']);
Route::get('user/teacher',[TeacherController::class,'index']);
Route::post('user/login',[AuthController::class,'login']);
