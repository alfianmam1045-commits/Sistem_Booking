<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use function Laravel\Prompts\error;

class PaymentController extends Controller
{
    public function getAllData()
    {
        try {
            $data = Payment::get();
            return ApiResponse::success($data, "Success To Get All Data");
        } catch (Exception $e) {
            return ApiResponse::error(message: "Internal Server Error", status: 500);
        }
    }
    public function getSingleData($id)
    {
        try {
            $data = Payment::where("payment_id", $id)->get();
            return ApiResponse::success($data, "Success To Get Single Data");
        } catch (Exception $e) {
            return ApiResponse::error(message: "Internal Server Error", status: 500);
        }
    }
    public function createData(Request $request)
    {
        try {
            $validated = $request->validate([
                'booking_id' => "sometimes|integer",
                'payment_method' => "sometimes|in:cash,transfer,ewallet",
                'amount' => "sometimes|integer",
                'payment_status' => 'sometimes|in:pending,paid,failed|nullable',
                'payment_date' => "sometimes|string|nullable",
            ]);

            $existing = Payment::where("booking_id", $validated["booking_id"])->first();
            if ($existing)
                return ApiResponse::error("Booking already has a payment");

            $data = Payment::create($validated);

            return ApiResponse::success($data, "Success To Create Data");

        } catch (Exception $e) {
            return ApiResponse::error(message: "Internal Server Error", status: 500);
        }
    }
    public function updateData(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'payment_method' => "required|in:cash,transfer,ewallet",
                'amount' => "required|integer",
                'payment_status' => 'sometimes|in:pending,paid,failed',
                'payment_date' => "sometimes|string|nullable",
            ]);

            $current = Payment::where("payment_id", $id)->first();
            if ($current["payment_status"] != "pending")
                return ApiResponse::error("Payment Status has been {$current['payment_status']}");

            $data = Payment::where("payment_id", $id)->update($validated);
            return ApiResponse::success($data, "Success To Update Data");
        } catch (Exception $e) {
            Log::alert($e);

            return ApiResponse::error(message: "Internal Server Error", status: 500);
        }
    }
    public function deleteData($id)
    {
        try {
            $data = Payment::where("payment_id", $id)->delete();
            return ApiResponse::success($data, "Success To Delete Data");
        } catch (Exception $e) {
            return ApiResponse::error(message: "Internal Server Error", status: 500);
        }
    }
}
