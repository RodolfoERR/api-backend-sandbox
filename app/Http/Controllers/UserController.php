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
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'f_name' => 'required|string|max:255',
            'l_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'active' => 'required|boolean',
            'code' => 'nullable|string|max:255',
            'fingerprint' => 'nullable|string|max:255',
            'role_id' => 'required|integer|exists:roles,id',
        ]);

        $user = new User();
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->f_name = $request->f_name;
        $user->l_name = $request->l_name;
        $user->phone = $request->phone;
        $user->active = $request->active;
        $user->code = $request->code;
        $user->fingerprint = $request->fingerprint;
        $user->role_id = $request->role_id;
        $user->save();

        return response()->json($user, 201);
        
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Return the validation errors
        return response()->json([
            'errors' => $e->errors()
        ], 422);
    } catch (\Exception $e) {
        // Log the error and return a generic error message
        //Log::error('Error creating user: ' . $e->getMessage());
        return response()->json(['error' => 'Error creating user'. $e->getMessage()], 500);
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
