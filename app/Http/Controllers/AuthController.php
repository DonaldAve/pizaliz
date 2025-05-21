<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'surname' => 'required|string|max:255',
                'phone_number' => 'required|string|min:8|max:20|unique:users',
                'adress_delivery' => 'required|string|min:8',
                'password' => 'required|string|min:8',
            ]);

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'surname' => $validated['surname'],
                'phone_number' => $validated['phone_number'],
                'adress_delivery' => $validated['adress_delivery'],
                'role' => 'user'
            ]);

            if (!$user) {
                throw new \Exception('Failed to create user');
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user->only(['id', 'name', 'email', 'role'])
            ], 201);

        } catch (\Exception $e) {
            \Log::error('Registration error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Registration failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => [__('auth.failed')],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => __('auth.logout_success')
        ]);
    }
}
