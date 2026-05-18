<?php

namespace App\Http\Controllers\Api\RBAC;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            'user_name' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email',
            'roleIds' => 'array',
            'roleIds.*' => 'exists:roles,id'
        ]);
        // use transaction for save user and roles when both of them is true.
        try {
            $user = DB::transaction(function () use ($validated, $id) {
                $user = User::findOrFail($id);
                //update user fields
                $user->update([
                    'user_name' => $validated['user_name'],
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                ]);
                // update roles
                if (isset($validated['roleIds'])) {
                    $user->syncRoles($validated['roleIds']);
                }
                // return update Model not a response!
                return $user->load('roles');
            });
            // return a response
            return response()->json([
                'success' => true,
                'data' => $user,
                'message' => 'user update successfully'
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'failed to update!',
                'error' => $e->getMessage()
            ], 500);
        }
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