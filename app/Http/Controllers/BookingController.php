<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Booking;
use Exception;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function getAllData()
    {
        try {
            $data = Booking::with(['user', 'service'])->get();
            return ApiResponse::success($data, "Success To Get All Data");
        } catch (Exception $e) {
            return ApiResponse::error(message: "Internal Server Error", status: 500);
        }
    }
    public function getSingleData($id)
    {
        try {
            $data = Booking::where("booking_id", $id)->with(['user', 'service'])->get();
            return ApiResponse::success($data, "Success To Get Single Data");
        } catch (Exception $e) {
            return ApiResponse::error(message: "Internal Server Error", status: 500);
        }
    }
    public function createData(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => "required|integer",
                'service_id' => "required|integer",
                'booking_date' => "required|date",
                'status' => 'sometimes|in:pending,confirmed,cancelled,completed|nullable',
                'total_price' => "required|integer",
            ]);

            $data = Booking::create($validated);

            return ApiResponse::success($data, "Success To Create Data");

        } catch (Exception $e) {
            return ApiResponse::error(message: "Internal Server Error", status: 500);
        }
    }
    public function updateData(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'user_id' => "sometimes|integer",
                'service_id' => "sometimes|integer",
                'booking_date' => "sometimes|date",
                'status' => 'sometimes|in:pending,confirmed,cancelled,completed|nullable',
                'total_price' => "sometimes|integer",
            ]);

            $data = Booking::where("booking_id", $id)->update($validated);
            return ApiResponse::success($data, "Success To Update Data");
        } catch (Exception $e) {

            return ApiResponse::error(message: "Internal Server Error", status: 500);
        }
    }
    public function deleteData($id)
    {
        try {
            $data = Booking::where("booking_id", $id)->delete();
            return ApiResponse::success($data, "Success To Delete Data");
        } catch (Exception $e) {
            return ApiResponse::error(message: "Internal Server Error", status: 500);
        }
    }
}
