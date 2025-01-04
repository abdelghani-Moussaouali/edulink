<?php

namespace App\Http\Controllers;

use App\Models\var_admin;
use Illuminate\Http\Request;

class var_adminController extends Controller
{
    public function create_new_var(Request $request)
    {
        $field = $request->validate([
            'name' => 'string|unique:var_admins|required',
            'value' => 'integer|required',
        ]);

        var_admin::create($field);

        return response()->json(
            [
                'message' => 'new variable created successfully',
            ],
            201
        );
    }
    public function update(Request $request, $id)
    {
        $field = $request->validate([
            'value' => 'integer|required',
        ]);

        $var = var_admin::find($id);
        if ($var === null) {
            return response()->json(
                [
                    'message' => 'variable not found',
                ],
                404
            );
        }

        $var->update($field);

        return response()->json(
            [
                'message' => 'variable updated successfully',
                'var' => $var,
            ],
            200
        );
    }

    public function delete(Request $request, $id)
    {
        $var = var_admin::find($id);
        $var_count = $var->count();
        if ($var === null) {
            return response()->json([
                'message' => 'variable not found',
            ], 404);
        }
        if ($var_count < 3) {
            return response()->json([
                'message' => 'this variable you can\'t delete it',
            ]);
        }

        $var->delete();



        return response()->json([
            'message' => 'the variable deleted sucessufully'
        ]);
    }
}
