<?php

namespace App\Http\Controllers\Api\RBAC;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return response()->json([
            'success' => true,
            'data' => $users,
            'message' => 'all users retrived successfuly.'
        ], 200);
    }

    public function show($id)
    {
        // get simple user data
        $user = User::find($id);
        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'requested user information retrived successfully.'
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_name' => 'required|string|unique:users,user_name',
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string'
        ]);

        $user = User::create($validated);

        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'new user created.'
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_name' => 'required',
            'name' => ''
        ]);

        $user_upd = User::updateOrFail($validated);

        return response()->json([
            'success' => true,
            'data' => $user_upd,
            'message' => 'user update successfully'
        ], 200);
    }

    public function getRolesByUserId($id)
    {
        $user = User::with('roles')->find($id);
        $roles = Role::all();

        $response = [
            'userData' => $user,
            'roles' => $roles
        ];

        return response()->json([
            'success' => true,
            'data' => $response,
            'message' => 'retrive user with roles successfully.'
        ], 200);

    }
}