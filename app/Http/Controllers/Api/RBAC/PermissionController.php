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
            'success'=>true,
            'data'=> $perms,
            'message'=> 'All permsissions retrived successfully.'
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'=>'required',Rule::unique('permissions')->where(function ($query) use ($request){
                return $query->where('guard_name', $request->guard_name);  
            }),
            'guard_name'=>'required|string'
        ]);

        $perm = Permission::create($validated);

        return response()->json([
            'success'=>true,
            'data'=> $perm,
            'message'=>'a permission created successfully.'
        ], 201);
    }

}