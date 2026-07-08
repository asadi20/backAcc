<?php

namespace App\Http\Controllers\Api\RBAC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $perms = Permission::all();
        return response()->json([
            'success' => true,
            'data' => $perms,
            'message' => 'All permsissions retrived successfully.'
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            Rule::unique('permissions')->where(function ($query) use ($request) {
                return $query->where('guard_name', $request->guard_name);
            }),
            'guard_name' => 'required|string'
        ]);

        $perm = Permission::create($validated);

        return response()->json([
            'success' => true,
            'data' => $perm,
            'message' => 'a permission created successfully.'
        ], 201);
    }

    public function show($id)
    {
        $perm = Permission::findOrFail($id);
        if ($perm) {
            return response()->json([
                'success' => true,
                'data' => $perm,
                'message' => 'requested permission retrived successfully.',
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'string|required|unique,permissions.id',
            'guard_name' => 'string|required'
        ]);

        $response = Permission::update($validated);

        return $response;

    }
}