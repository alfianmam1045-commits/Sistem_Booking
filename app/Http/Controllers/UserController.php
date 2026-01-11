<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function getAllData()
    {
        try {
            $data = User::with([])->get();
            return ApiResponse::success($data, "Success To Get All Data");
        } catch (Exception $e) {
            return ApiResponse::error(message: "Internal Server Error", status: 500);
        }
    }
    public function getSingleData($id)
    {
        try {
            $data = User::where("user_id", $id)->with([])->get();
            return ApiResponse::success($data, "Success To Get Single Data");
        } catch (Exception $e) {
            return ApiResponse::error(message: "Internal Server Error", status: 500);
        }
    }
    public function createData(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => "required|string",
                'email' => "required|string|email",
                'phone' => "required|integer",
                'password' => 'required|string',
                'role' => "required|in:admin,user",
            ]);
            $validated["password"] = Hash::make($validated["password"]);
            $data = User::create($validated);

            return ApiResponse::success($data, "Success To Get Create Data");

        } catch (Exception $e) {
            return ApiResponse::error(message: "Internal Server Error", status: 500);
        }
    }
    public function updateData(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'name' => "sometimes|string",
                'email' => "sometimes|string|email",
                'phone' => "sometimes|integer",
                'password' => 'sometimes|string|nullable',
                'role' => "sometimes|in:admin,user",
            ]);
            if ($validated["password"] ?? false)
                $validated["password"] = Hash::make($validated["password"]);
            $data = User::where("user_id", $id)->update($validated);
            return ApiResponse::success($data, "Success To Update Data");
        } catch (Exception $e) {
            Log::alert($e);
            return ApiResponse::error(message: "Internal Server Error", status: 500);
        }
    }
    public function deleteData($id)
    {
        try {
            $data = User::where("user_id", $id)->delete();
            return ApiResponse::success($data, "Success To Get Delete Data");
        } catch (Exception $e) {
            return ApiResponse::error(message: "Internal Server Error", status: 500);
        }
    }
}
