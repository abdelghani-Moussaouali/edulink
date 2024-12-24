<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\TeacherMiddleware;
use App\Models\project;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;


// public route for students 
Route::post('user/register', [AuthController::class, 'register']); // register user work
Route::get('user/', [UserController::class, 'index']); // get all user (admin,students,teacher) work 
Route::get('user/students', [StudentController::class, 'index']); //get all students  work 
// login user 
Route::post('user/login', [AuthController::class, 'login']); //  work


Route::middleware('auth:sanctum')->group(function () {
    Route::post('user/login', [AuthController::class, 'login']);
    // update user profile
    Route::put('user/update', [AuthController::class, 'update']); //  work
    // logout the user
    Route::post('user/logout', [AuthController::class, 'logout']); //  work

});
// get all students 
Route::get('user/admin', [AdminController::class, 'index'],)->middleware('auth:sanctum', Admin::class);


// teacher routes :


Route::middleware(['auth:sanctum', TeacherMiddleware::class])->group(function () {
    Route::get('user/teacher', [TeacherController::class, 'index']); // get all teacher work 
    Route::post('user/teacher/project', [ProjectController::class, 'store']);
});
