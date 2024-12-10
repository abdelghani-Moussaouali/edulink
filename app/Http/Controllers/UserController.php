<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    public function index()
    {

        try {
            $user = User::all();
            return response()->json(
                ['data' => UserResource::collection($user)],
                200
            );
        } catch (Exception $ex) {
            return response()->json(
                ['message' => $ex->getMessage()],
                401
            );
        }
    }



 }






 