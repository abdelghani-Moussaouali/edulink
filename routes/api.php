<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicationsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\var_adminController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\StdTeach;
use App\Http\Middleware\TeacherMiddleware;
use App\Models\project;
use App\Models\var_admin;
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
    Route::get('user/teacher/project', [ProjectController::class, 'show']); // show project accepted not pending
});

// ======> permission for admin
Route::middleware(['auth:sanctum', Admin::class])->group(function () {
    Route::get('user/admin/project', [ProjectController::class, 'index']); // show all projects 
    Route::get('user/admin/application', [ApplicationsController::class, 'index']); // show all application 
    Route::get('user/', [UserController::class, 'index']); // get all user (admin,students,teacher) 
    Route::put('user/project/{id}', [ProjectController::class, 'edit']); // update project status 
    Route::put('user/students/{id}', [StudentController::class, 'statusChange']); // update student status
    Route::get('user/admin', [AdminController::class, 'index']); // show admin profile
    // variables :	Configure Project Parameters
    Route::post('user/admin/var', [var_adminController::class, 'create_new_var']); // create new variable after the scond one
    Route::put('user/admin/var/{id}/update', [var_adminController::class, 'update']); // update value of the variable
    Route::delete('user/admin/var/{id}', [var_adminController::class, 'delete']); // delete the variable id>=3

});


// ======> permission for teacher,admin
Route::middleware(['auth:sanctum', TeacherMiddleware::class,])->group(function () {
    Route::get('user/teacher', [TeacherController::class, 'index']); // show all teacher  
    Route::get('user/teacher/profile', [TeacherController::class, 'show']); // show teacher profile
    // project routes :


    Route::post('user/project', [ProjectController::class, 'store']); // create the project
    Route::put('user/teacher/project/{id}', [ProjectController::class, 'update']); // update project
    Route::delete('user/teacher/project/{id}', [ProjectController::class, 'destroy']); // update project

});




// Student Functionalities
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('student')->group(function () {
        Route::get('/projects', [StudentController::class, 'viewProjects']);
        Route::post('/groups', [GroupController::class, 'store']); //make a group
        Route::post('/applications', [StudentController::class, 'applyForProject']); //make an application
        Route::get('/applications', [StudentController::class, 'viewApplications']);
Route::get('/profile', [StudentController::class, 'show']);
        Route::put('/profile', [StudentController::class, 'updateProfile']);
        Route::get('/dashboard', [StudentController::class, 'getDashboardStats']);
    });
});





// specialization change to relation in teacher and student with boolean attribute to separate

// 