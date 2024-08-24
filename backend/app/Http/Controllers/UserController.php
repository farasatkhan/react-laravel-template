<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function getAllUsers() {
        return response()->json(User::all());
    }

    public function createUser(Request $request) {

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
        ];

        $messages = [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email address is already in use.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters.',
        ];

        $validatedData = $request->validate($rules, $messages);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json($user, 201);
    }

    public function getUser($id) {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        return response()->json($user);
    }

    public function deleteUser($id) {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        $user->delete();

        return response()->json([
            'message' => 'User deleted',
        ]);
    }

    public function UpdateEmail(Request $request) {
        $rules = [
            'email' => 'required|email|unique:users,email',
        ];

        $messages = [
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email address is already in use.',
        ];

        $validatedData = $request->validate($rules, $messages);

        $user = User::find($request->id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        $user->email = $request->email;
        $user->save();

        return response()->json($user);
    }
}
