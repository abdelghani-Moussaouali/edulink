<?php

namespace App\Http\Controllers;

use App\Http\Resources\applicationsResource;
use App\Models\applications;
use Exception;
use Illuminate\Http\Request;

class ApplicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $app = applications::all();
        return response()->json(
            applicationsResource::collection($app),
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(applications $applications)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {

        $app = applications::find($id);
        if ($app  === null) {
            return response()->json(
                [
                    'message' => 'application not found',
                ],
                404
            );
        }
        $field = $request->validate([
            'status' => 'string|in:open,accepted, rejected',
        ]);
        try {
            $app->update($field);
            return response()->json(
                [
                    'message' => 'the application was updated successfully',
                    'project' => $app,
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
    public function update(Request $request, applications $applications)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(applications $applications)
    {
        //
    }
}
