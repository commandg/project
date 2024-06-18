<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phonenumber' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:student,teacher',
            'photo_license' => $request->role == 'teacher' ? 'required|image|mimes:jpeg,png|max:2048' : '', // Conditional validation
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'phonenumber' => $request->phonenumber,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        if ($request->role == 'teacher') {
            // Only create Teacher model if the role is teacher and photo license is provided
            Teacher::create([
                'user_id' => $user->id,
                'photo_license' => $request->file('photo_license') ? $request->file('photo_license')->store('teacher_photos') : null,
                'is_teacher' => false, // Default to not a teacher until changed by admin
            ]);
        }

        // Generate token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User registered successfully',
            'token' => $token
        ], 201);
    }

    //----------------------------------------------------------------------------------------------


    public function login(Request $request)
    {
        // Validate inputs
        $validator = Validator::make($request->all(), [
            'email' => 'nullable|email',
            'phonenumber' => 'nullable|string',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $email = $request->input('email');
        $phonenumber = $request->input('phonenumber');
        $password = $request->input('password');

        // Ensure either email or phonenumber is provided
        if (!$email && !$phonenumber) {
            return response()->json(['message' => 'Email or phonenumber is required'], 400);
        }

        // Find user by email or phonenumber
        $user = User::where('email', $email)
            ->orWhere('phonenumber', $phonenumber)
            ->first();

        if ($user && Hash::check($password, $user->password)) {
            // Generate token
            $token = $user->createToken('auth_token')->plainTextToken;

            if ($user->role == 'teacher') {
                $teacher = $user->teacher;
                if ($teacher && $teacher->is_teacher) {
                    Auth::login($user);
                    return response()->json([
                        'message' => 'Teacher logged in successfully',
                        'token' => $token
                    ], 200);
                } else {
                    return response()->json(['message' => 'Teacher authentication failed'], 403);
                }
            } elseif ($user->role == 'student') {
                Auth::login($user);
                return response()->json([
                    'message' => 'Student logged in successfully',
                    'token' => $token
                ], 200);
            } elseif ($user->role == 'admin') {
                Auth::login($user);
                return response()->json([
                    'message' => 'Admin logged in successfully',
                    'token' => $token
                ], 200);
            }
        }

        return response()->json(['message' => 'Login failed'], 401);
    }
    //-------------------------------------------------------------------------



    public function logout(Request $request)
    {
        // Get the authenticated user
        $user = $request->user();

        // Revoke the token that was used to authenticate the current request
        $user->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }


}

//'photo_license' => 'required|image|mimes:jpeg,png|max:2048',