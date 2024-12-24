<?php

namespace App\Http\Controllers;

use App\Http\Resources\projectResource;
use App\Models\project;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $project = project::all();
        return response()->json(
            projectResource::collection($project),
            200
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $field = $request->validate([
            'title' => 'unique:projects|string|required|min:5',
            'description' => 'string|required',
            'status' => 'string|in:open,in progress,submitted,closed',
            'specializations_id' => 'integer',
            'keywords' => 'required|array',
            'keywords.*' => 'string',
        ]);
        $field['status'] = $field['status'] ?? 'open';
        $field['teachers_id'] = Auth::user()->teachers->id;


        project::create($field);
        return response()->json(
            [
                'message' => 'the project was created successfully',
            ],

        );
    }

    /**
     * Display the specified resource.
     */
    public function show(project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(project $project)
    {
        //
    }
}
