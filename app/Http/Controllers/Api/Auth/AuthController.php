<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
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
                'message' => 'login successfull',
                'error' => null
            ]);

        }

        throw ValidationException::withMessages([
            'user name' => 'error in validation with requested inputs,'
        ]);
    }
}