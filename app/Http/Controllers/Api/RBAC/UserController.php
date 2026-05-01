<?php

namespace App\Http\Controllers\Api\RBAC;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return response()->json([
            'success'=> true,
            'data'=> $users,
            'message'=> 'all users retrived successfuly.'
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_name'=>'required|string|unique:users,user_name',
            'name'=>'required|string',
            'email'=>'required|string|unique:users,email',
            'password'=>'required|string'
        ]);

        $user = User::create($validated);

        return response()->json([
            'success'=> true,
            'data'=> $user,
            'message'=>'new user created.'
        ], 201);
    }
}