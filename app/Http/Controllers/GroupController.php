<?php

namespace App\Http\Controllers;

use App\Models\group;
use App\Models\group_student;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $group = $request->validate([
            'projects_id' => 'required|exists:projects,id',
            'group_leader' => 'required|exists:students,id',

        ]);
        $group_student = $request->validate([
            'group_id' => 'required|exists:groups,id',
            'student_ids' => 'required|array',
            'student_ids.*' => 'exists:students,id',
        ]);

        // Create a new group
        $newGroup = Group::create($group);

        // Attach students to the group
        $newGroup->students()->attach($group_student['student_ids']);


        group_student::create($group_student);

        return response()->json([
            'message' => 'Group created successfully.',
            'group' => $newGroup,
        ]);
























        // $group = Group::find($request->group_id);

        // // Attach students to the group
        // $group->students()->syncWithoutDetaching($request->student_ids);

        return response()->json([
            'message' => 'Students added to the group successfully.',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(group $group)
    {
        //
    }
}
