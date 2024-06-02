<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserThese;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Find the user by email
        $user = UserThese::where('email', $validated['email'])->first();

        // Check if user exists and passwords match
        if ($user) {
            // Passwords match
            return response()->json([
                'status' => 200,
                'message' => 'Login successful',
                'data' => $user
            ], 200);
        } else {
            // Invalid credentials
            return response()->json([
                'status' => 401,
                'message' => 'Invalid credentials',
            ], 401);
        }
    }
}
