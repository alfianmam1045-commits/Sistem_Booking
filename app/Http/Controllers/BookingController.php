<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Service;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
                'user_id' => "required|integer|exists:users,user_id",
                'service_id' => "required|integer|exists:services,service_id",
                'booking_date' => "required|date",
                'payment_method' => 'sometimes|in:cash,transfer,ewallet|nullable'
            ]);

            $booking = Booking::create($validated);

            $service = Service::where("service_id", $validated["service_id"])->first();

            Payment::create([
                "booking_id" => $booking["booking_id"],
                "amount" => $service["price"],
                "payment_method" => $validated["payment_method"] ?? null
            ]);

            $data = Booking::where("booking_id", $booking["booking_id"])->with(["payment"])->first();

            return ApiResponse::success($data, "Success To Create Data");

        } catch (Exception $e) {
            Log::alert($e);
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

            $current = Booking::where("booking_id", $id)->first();

            if ($current["status"] != "pending")
                return ApiResponse::error("Cant Update Data");

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
