<?php

// controlador de usuario

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'email' => 'required|email|unique:users',
            'f_name' => 'required',
            'l_name' => 'required',
            'phone' => 'required|string',
            'active' => 'boolean',
            'fingerprint' => 'required',
            'password' => 'required',
            'code' => 'required|size:6',
            'role_id' => 'required|exists:roles,id',
            'email_verified_at' => 'nullable|date',
        ]);

        $user = User::create($validated);
        return response()->json($user, 201);
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Return the validation errors
        return response()->json([
            'errors' => $e->errors()
        ], 422);
    } catch (\Exception $e) {
        // Log the error and return a generic error message
        // Log::error('Error creating user: ' . $e->getMessage());
        return response()->json(['error' => 'Error creating user'], 500);
    }
}


    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'email|unique:users,email,' . $id,
            'f_name' => 'required',
            'l_name' => 'required',
            'phone' => 'numeric',
            'active' => 'boolean',
            'fingerprint' => 'required',
            'password' => 'required',
            'code' => 'required|size:6',
            'role_id' => 'required|exists:roles,id',
            'email_verified_at' => 'nullable|date',
        ]);

        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->update($request->all());
        return response()->json($user, 200);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->delete();
        return response()->json("The user has been deleted", 204);
    }
}
