<?php

namespace App\Http\Controllers;

use App\Http\Resources\studentResource;
use App\Models\Admin;
use App\Models\student;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function index(){
        $users = student::all();
        return studentResource::collection($users);
    }


   



}
