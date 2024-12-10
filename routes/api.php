<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


//testing 

Route::get('test',[UserController::class,'test']);


// public route for students 
Route::post('user/register',[AuthController::class,'register']); // register user work
Route::get('user/',[UserController::class,'index']); // get all user (admin,students,teacher) work 
Route::get('user/students',[StudentController::class,'index']); //get all students  work 
Route::get('user/teacher',[TeacherController::class,'index']); // get all teacher work 

// login user 
Route::post('user/login',[AuthController::class,'login'])->middleware('auth:sanctum'); //  work

// update user profile
Route::post('user/update',[AuthController::class,'update'])->middleware('auth:sanctum'); //  work

// logout the user
Route::post('user/logout',[AuthController::class,'logout'])->middleware('auth:sanctum'); //  work

// 