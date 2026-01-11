<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;

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
                'booking_id' => "required|integer",
                'payment_method' => "required|in:cash,transfer,ewallet",
                'amount' => "required|integer",
                'payment_status' => 'sometimes|in:pending,paid,failed|nullable',
                'payment_date' => "sometimes|string|nullable",
            ]);


            $data = Payment::where("payment_id", $id)->update($validated);
            return ApiResponse::success($data, "Success To Update Data");
        } catch (Exception $e) {

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
