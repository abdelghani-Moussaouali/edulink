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
Route::post('user/register', [AuthController::class, 'register']); // register user 
Route::get('user/', [UserController::class, 'index']); // get all user (admin,students,teacher)  
Route::get('user/students', [StudentController::class, 'index']); //get all students   
// login user 
Route::post('user/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('user/login', [AuthController::class, 'login']);
    Route::put('user/update', [AuthController::class, 'update']); // update user profile
    Route::post('user/logout', [AuthController::class, 'logout']); // logout the user
});


Route::middleware('auth:sanctum')->group(function () {
    // get all students 
    Route::get('user/admin', [AdminController::class, 'index'],);
});
// teacher routes :
Route::middleware(['auth:sanctum', TeacherMiddleware::class])->group(function () {
    Route::get('user/teacher', [TeacherController::class, 'index']); // get all teacher  
    Route::get('user/teacher/project', [ProjectController::class, 'index']); // show all projects 

    Route::get('user/teacher/profile', [TeacherController::class, 'show']); // show teacher profile
    // project routes :
    Route::post('user/teacher/project', [ProjectController::class, 'store']); // create the project
    Route::put('user/teacher/project', [ProjectController::class, 'update']); // update the project


});




// make changes in project resource 
