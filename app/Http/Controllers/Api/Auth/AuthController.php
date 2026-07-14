<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    public function show(Request $request)
    {
        return new UserResource($request->user());
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'user_name' => 'required|string',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            // for session fixation
            $request->session()->regenerate();

            return response()->json([
                'user' => $request->user(),
                'success' => true,
                'message' => 'login successful',
                'error' => null
            ]);

        }

        throw ValidationException::withMessages([
            'user name' => 'error in validation with requested inputs,'
        ]);
    }

    public function register(Request $request)
    {
        // removed try-catch clock to use laravel handle validation errors.
        $userData = $request->validate([
            'user_name' => ['required', 'string', 'unique:users,user_name'],
            'email' => ['email', 'string', 'required', 'unique:users,email'],
            'name' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6']
        ]);

        $user = User::create([
            'user_name' => $userData['user_name'],
            'email' => $userData['email'],
            'name' => $userData['name'],
            'password' => Hash::make($userData['password'])
        ]);

        // auto login after successful registration.
        Auth::login($user);

        // session fixation
        $request->session()->regenerate();

        return response()->json([
            'success' => true,
            'message' => 'You have been successfully register to this system.',
            'data' => $user,
            'error' => null
        ], 201);

    }
}
