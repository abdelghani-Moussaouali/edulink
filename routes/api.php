<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\StdTeach;
use App\Http\Middleware\TeacherMiddleware;
use App\Models\project;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

// public route for guest  
Route::post('user/register', [AuthController::class, 'register']); // register user  
Route::get('user/students', [StudentController::class, 'index']); //get all students   
Route::post('user/login', [AuthController::class, 'login']);  // login user

// for all users have a token :admin,student,teacher
Route::middleware('auth:sanctum')->group(function () {
    // authenticatation routes
    Route::put('user/update', [AuthController::class, 'update']); // update user profile
    Route::post('user/logout', [AuthController::class, 'logout']); // logout the user
    //projects route
    Route::get('user/teacher/project', [ProjectController::class, 'show']); // show project accepted not open
});

// permission for admin
Route::middleware(['auth:sanctum', Admin::class])->group(function () {
    Route::get('user/admin/project', [ProjectController::class, 'index']); // show all projects 
    Route::get('user/', [UserController::class, 'index']); // get all user (admin,students,teacher) 
    Route::put('user/project/{id}', [ProjectController::class, 'edit']); // update the status of project
    Route::put('user/students/{id}', [StudentController::class, 'edit']); // update the status of project


});

// permission for teacher,admin
Route::middleware(['auth:sanctum', TeacherMiddleware::class,])->group(function () {
    Route::get('user/teacher', [TeacherController::class, 'index']); // show all teacher  
    Route::get('user/teacher/profile', [TeacherController::class, 'show']); // show teacher profile
    // project routes :
    Route::post('user/project', [ProjectController::class, 'store']); // create the project
    Route::put('user/teacher/project/{id}', [ProjectController::class, 'update']); // update the status of project
});





// permission for student,admin
Route::middleware(['auth:sanctum', TeacherMiddleware::class,])->group(function () {
    Route::post('user/group', [GroupController::class, 'create']);  // create the group
});
