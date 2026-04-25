<?php

namespace App\Http\Controllers\Api\RBAC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        // show all roles
        $roles = Role::all();
        return response()->json([
            'success' => true,
            'data' => $roles,
            'message' => 'all roles retrived successfully.'
        ], 200);
    }

    public function store(Request $requets)
    {
        $validated = $requets->validate([
            'name' => [
                'required',
                Rule::unique('roles')->where(function ($query) use ($requets) {
                    return $query->where('guard_name', $requets->guard_name);
                }),
            ],
            'guard_name' => 'required|string'
        ]);

        $newRole = Role::create($validated);

        return response()->json([
            'success' => true,
            'data' => $newRole,
            'message' => 'New Role added to system.'
        ], 201);
    }
}
