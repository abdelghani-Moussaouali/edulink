<?php

namespace App\Http\Controllers;

use App\Models\teacher;
use App\Http\Requests\StoreteacherRequest;
use App\Http\Requests\UpdateteacherRequest;
use App\Http\Resources\teacherResource;
use App\Http\Resources\UserResource;
use Exception;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        try {
            $user = teacher::all();
            return response()->json(
                ['data' => teacherResource::collection($user)],
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreteacherRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(teacher $teacher)
    {
        $teacher  = Auth::user()->teachers;
        return new teacherResource($teacher);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
  

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(teacher $teacher)
    {
        //
    }
}
