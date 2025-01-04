<?php

namespace App\Http\Controllers;

use App\Http\Resources\studentResource;
use App\Http\Resources\UserResource;
use App\Models\applications;
use App\Models\project;
use App\Models\student;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {

    //     try {
    //         $student = student::all();
    //         return response()->json(
    //             studentResource::collection($student),
    //             200
    //         );
    //     } catch (Exception $ex) {
    //         return response()->json(
    //             ['message' => $ex->getMessage()],
    //             401
    //         );
    //     }
    // }


    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function statusChange(Request $request, $id)
    // {
    //     $user = User::find($id);
    //     if ($user === null) {
    //         return response()->json(
    //             [
    //                 'message' => 'the user not found',
    //             ],
    //             404
    //         );
    //     }
    //     $user->isActive = !$user->isActive;
    //     $user->save();
    //     return response()->json([
    //         'message' => 'the student status was updated successfully',
    //        'student' => new UserResource($user),
    //     ]);
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
  

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



    public function index()
    {
        try {
            $students = Student::with('users')->get();
            return response()->json(
                StudentResource::collection($students),
                200
            );
        } catch (Exception $ex) {
            return response()->json(
                ['message' => $ex->getMessage()],
                401
            );
        }
    }
    public function show(student $student)
    {
        $student  = Auth::user()->students;
        return new studentResource($student);
    }
    // View available projects
    public function viewProjects()
    {
        try {
            $projects = project::where('status', 'open')->get();
            return response()->json($projects, 200);
        } catch (Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 400);
        }
    }



    // Apply for a project
    public function applyForProject(Request $request)
    {
        try {
            $validated = $request->validate([
                'project_id' => 'required|integer|exists:projects,id',
                'group_id' => 'required|integer|exists:groups,id'
            ]);

            // Check if already applied
            $existingApplication = applications::where([
                'group_id' => $validated['group_id'],
                'project_id' => $validated['project_id']
            ])->first();

            if ($existingApplication) {
                return response()->json([
                    'message' => 'Already applied for this project'
                ], 400);
            }

            $application = applications::create([
                'group_id' => $validated['group_id'],
                'project_id' => $validated['project_id'],
                'status' => 'pending',
                'applied_at' => now(),
                'isApproved' => false
            ]);

            return response()->json([
                'message' => 'Application submitted successfully',
                'application' => $application
            ], 201);
        } catch (Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 400);
        }
    }

    // View application status
    public function viewApplications(Request $request)
    {
        try {
            $student = $request->user()->students()->where('users_id', Auth::id())->first();
            $applications = applications::where('groups_id', $student->group_id)
                ->with('project')
                ->get();

            return response()->json($applications, 200);
        } catch (Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 400);
        }
    }

    // Update student profile
    public function updateProfile(Request $request)
    {
        try {
            $validated = $request->validate([
                'skills' => 'required|string',
                'phone' => 'required|string|max:15',
                'profile_picture' => 'nullable|image|max:2048'
            ]);

            $student = Auth::user()->student;
            $student->skills = $validated['skills'];
            $student->save();

            // Update user profile
            $user = Auth::user();
            $user->phone = $validated['phone'];
            $user->specialization = $validated['specialization'];

            if ($request->hasFile('profile_picture')) {
                $path = $request->file('profile_picture')->store('profiles', 'public');
                $user->profile_picture = $path;
            }

            // $user->save();

            return response()->json([
                'message' => 'Profile updated successfully',
                'student' => new StudentResource($student)
            ], 200);
        } catch (Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 400);
        }
    }

    // Get student dashboard stats
    public function getDashboardStats()
    {
        try {
            $user = Auth::user();

            // Check if the user is authenticated
            if (!$user) {
                return response()->json(['message' => 'User is not authenticated.'], 401);
            }

            $student = $user->student;
            $applications = applications::where('groups_id', $student->groups_id)->get();

            $stats = [
                'total_applications' => $applications->count(),
                'pending_applications' => $applications->where('status', 'pending')->count(),
                'accepted_applications' => $applications->where('status', 'accepted')->count(),
                'rejected_applications' => $applications->where('status', 'rejected')->count(),
            ];

            return response()->json($stats, 200);
        } catch (Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 400);
        }
    }
}
