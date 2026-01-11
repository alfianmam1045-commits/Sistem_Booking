<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Log;
use Exception;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function getAllData()
    {
        try {
            $data = Log::orderByDesc()->get();
            return ApiResponse::success($data);
        } catch (Exception $e) {
            return ApiResponse::error();
        }
    }
}
