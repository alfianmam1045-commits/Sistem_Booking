<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function me()
    {
        try {
            $data = Auth::user();
            return ApiResponse::success("Login Success", $data);
        } catch (Exception $e) {
            return ApiResponse::error("Internal Server Error", 500);
        }
    }
    public function login(Request $request)
    {
        try {
            $credential = $request->only(['email', 'password']);
            if (!$token = Auth::guard('api')->attempt($credential)) {
                return ApiResponse::error("Unauthorized", 401);
            }
            return ApiResponse::success("Login Success", ['token' => $token]);
        } catch (Exception $e) {
            return ApiResponse::error("Internal Server Error", 500);
        }
    }
    public function register(Request $request)
    {
        try {
            $validated = $request->validate([
                "name" => ['required', 'string'],
                "email" => ['required', 'string', 'email'],
                "password" => ['required', 'string'],
                "phone" => ['required', 'integer'],
                "role" => ['sometimes', 'in:admin,user'],
            ]);
            $user = User::create($validated);
            return ApiResponse::success("Register Success", $user);
        } catch (Exception $e) {
            return ApiResponse::error("Internal Server Error", 500);
        }
    }
    public function refresh()
    {
        try {
            $token = Auth::guard('api')->refresh();
            return ApiResponse::success("Refresh Token Success", ['token' => $token]);
        } catch (Exception $e) {
            return ApiResponse::error("Internal Server Error", 500);
        }
    }
    public function logout()
    {
        try {
            Auth::guard('api')->invalidate();
            return ApiResponse::success("Logout Success");
        } catch (Exception $e) {
            return ApiResponse::error("Internal Server Error", 500);
        }
    }
}
