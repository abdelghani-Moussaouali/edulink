<?php

namespace App\Http\Controllers;

use App\Http\Resources\projectResource;
use App\Models\project;
use App\Models\var_admin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\Xml\Project as XmlProject;

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
            'status' => 'string|in:pending,open, in progress, submitted, closed',
            'specializations_id' => 'integer',
            // 'keywords' => 'required|array',
            // 'keywords.*' => 'string',
        ]);
        $field['status'] = $field['status'] ?? 'pending';
        // $field['keywords'] = $field['keywords'];

        $field['teachers_id'] = Auth::user()->teachers->id;

        $proj_count = $request->user()->teachers()
            ->with('projects')
            ->get()
            ->pluck('projects')
            ->flatten()->count();

        $max_project = db::table('var_admins')->select('value')->get('value')->first()->value;

        if (Auth::user()->role == 'admin') {
            return response()->json(
                [
                    'message' => 'unauthenticated request',
                ],
            );
        } else if ($max_project === 0) {
            return response()->json(
                [
                    'message' => 'admin does not update max of project and it equal 0',
                ],
                403
            );
        } else if ($proj_count === $max_project) {
            return response()->json(
                [
                    'message' => 'project limit reached',
                ],
                403
            );
        }

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
        $project = project::where('status', '!=', 'pending')->get();
        return response()->json(
            projectResource::collection($project),
            200
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $project = Project::find($id);
        if ($project === null) {
            return response()->json(
                [
                    'message' => 'project not found',
                ],
                404
            );
        }
        $field = $request->validate([
            'status' => 'string|in:open, in progress, submitted, closed',
        ]);
        try {
            $project->update($field);
            return response()->json(
                [
                    'message' => 'the project was updated successfully',
                    'project' => $project,
                ],
                200
            );
        } catch (Exception $th) {
            return response()->json(
                [
                    'message' => 'the project wasn\'t updated , there is error'

                ],
                500
            );
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $proj = $request->user()->teachers()
            ->with('projects')
            ->get()
            ->pluck('projects')
            ->flatten();
        $project = $proj->get($id - 1);
        if ($project === null) {
            return response()->json(
                [
                    'message' => 'project not found',
                ],
                404
            );
        }
        $field = $request->validate([
            'title' => 'unique:projects|string|min:5',
            'description' => 'string',
            'specializations_id' => 'integer',

        ]);
        $project->update($field);
        return response()->json(
            [
                'message' => 'the project was created successfully',
                'pro' =>  $project,
            ],

        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $proj = $request->user()->teachers()
            ->with('projects')
            ->get()
            ->pluck('projects')
            ->flatten();
        $project = $proj->get($id - 1);
        if ($project === null) {
            return response()->json(
                [
                    'message' => 'project not found',
                ],
                404
            );
        }

        return response()->json([
            'project' => $project,
           'message' => 'project deleted successfully',
        ]);
    }
}
