<?php

namespace App\Http\Controllers;

use App\Http\Resources\studentResource;
use App\Http\Resources\UserResource;
use App\Models\student;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        try {
            $student = student::all();
            return response()->json(
                studentResource::collection($student),
                200
            );
        } catch (Exception $ex) {
            return response()->json(
                ['message' => $ex->getMessage()],
                401
            );
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function edit(Request $request, $id)
    {
        $user = User::find($id);
        if ($user === null) {
            return response()->json(
                [
                    'message' => 'the user not found',
                ],
                404
            );
        }
        $user->isActive = !$user->isActive;
        $user->save();
        return response()->json([
            'message' => 'the student status was updated successfully',
           'student' => new UserResource($user),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
    }

    /**
     * Display the specified resource.
     */
    public function show(student $student)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(student $student)
    {
        //
    }
}
