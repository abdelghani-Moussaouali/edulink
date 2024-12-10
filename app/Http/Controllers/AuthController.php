<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Resources\studentResource;
use App\Http\Resources\teacherResource;
use App\Http\Resources\UserResource;
use App\Models\Admin;
use App\Models\student;
use App\Models\teacher;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Enum;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validation = $request->validate([
            'name' => 'string|required|min:3',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed',
            'role' => 'required|in:teacher,student,admin',
            'phone_number' => 'numeric',
            'image_profile' => 'image|mimes:jpeg,jfif,png,jpg,gif,svg|max:2048',
            'specialization' => 'string|min:3',
        ]);

        $validation['role'] = $request->role;
        $user = User::create(attributes: $validation);
        if ($validation['role'] == 'student') {
            
            $st_validation = $request->validate([
                'skills' => 'string|nullable',
                'users_id' => 'integer'
            ]);
            $st_validation['users_id'] = $user->id;
            $student = student::create($st_validation);
            $token = $user->createToken($request->name)->plainTextToken;
            return response()->json(
                [
                    'role'=>$validation['role'],
                    'data' =>$student,
                    'token' =>$token,
                ],
                200
            );
        } else if ($validation['role'] == 'teacher') {
           
            $st_validation = $request->validate([
                'users_id' => 'integer',
                'max_project' => 'integer',

            ]);
            $st_validation['users_id'] = $user->id;
            $teacher = teacher::create($st_validation);
            $token = $user->createToken($request->name)->plainTextToken;
            return response()->json(
                [
                    'role'=>$validation['role'],
                    'data' => $teacher,
                    'token' => $token,

                ],
                200
            );
        } else {
            return response()->json(
                [

                    'message' => 'the regisiter is failed try again'
                ],
                500
            );
        }
    }
    public function update(Request $request)
    {
        $field = $request->validate([
            'name' => 'string',
            'email' => 'email|unique:users',
            'password' => 'min:8|confirmed',
        ]);

        $user = $request->user();
        $user->update($field);
        $token = $user->createToken($request->name);
        return [
            'user' => new UserResource($user),
            'token' => $token->plainTextToken,
        ];
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:8',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(
                ['message' => 'confirm your email & password and try again',],
                401,
            );
        } else if ($user->id != Auth::user()->id) {
            return response()->json(
                ['message' => 'your token is incorrect',],
                401,
            );
        }
        $token = $user->createToken($user->name);
        return response()->json([
            'request' => 'you log in your compte secussfully',
            'token' => $token->plainTextToken,

        ], 200,);
    }


    public function logout(Request $request)
    {
        try {
            $request->user()->delete();
            $request->user()->tokens()->delete();
            return response()->json(
                ['message' => 'you logout from your compte'],
                200,
            );
        } catch (Exception $ex) {
            return response()->json(
                ['message' => $ex->getMessage()],
                200,
            );
        }
    }
}