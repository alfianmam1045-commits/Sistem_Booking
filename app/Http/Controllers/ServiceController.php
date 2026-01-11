<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Service;
use Exception;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function getAllData()
    {
        try {
            $data = Service::get();
            return ApiResponse::success($data, "Success To Get All Data");
        } catch (Exception $e) {
            return ApiResponse::error(message: "Internal Server Error", status: 500);
        }
    }
    public function getSingleData($id)
    {
        try {
            $data = Service::where("service_id", $id)->get();
            return ApiResponse::success($data, "Success To Get Single Data");
        } catch (Exception $e) {
            return ApiResponse::error(message: "Internal Server Error", status: 500);
        }
    }
    public function createData(Request $request)
    {
        try {
            $validated = $request->validate([
                'service_name' => "required|string",
                'description' => "required|string",
                'price' => "required|integer",
                'status' => 'sometimes|in:active,inactive|nullable',
            ]);

            $data = Service::create($validated);

            return ApiResponse::success($data, "Success To Create Data");

        } catch (Exception $e) {
            return ApiResponse::error(message: "Internal Server Error", status: 500);
        }
    }
    public function updateData(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'service_name' => "sometimes|string",
                'description' => "sometimes|string",
                'price' => "sometimes|integer",
                'status' => 'sometimes|in:active,inactive',
            ]);

            $data = Service::where("service_id", $id)->update($validated);
            return ApiResponse::success($data, "Success To Update Data");
        } catch (Exception $e) {

            return ApiResponse::error(message: "Internal Server Error", status: 500);
        }
    }
    public function deleteData($id)
    {
        try {
            $data = Service::where("service_id", $id)->delete();
            return ApiResponse::success($data, "Success To Delete Data");
        } catch (Exception $e) {
            return ApiResponse::error(message: "Internal Server Error", status: 500);
        }
    }
}
