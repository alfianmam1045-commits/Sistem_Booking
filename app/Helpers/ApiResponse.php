<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    /**
     * Success Response
     */
    public static function success(
        string $message = 'Success',
        $data = null,
        int $statusCode = 200
    ): JsonResponse {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    /**
     * Error Response
     */
    public static function error(
        string $message = 'Error',
        $errors = null,
        int $statusCode = 400
    ): JsonResponse {
        return response()->json([
            'status' => false,
            'message' => $message,
            'errors' => $errors,
        ], $statusCode);
    }

    /**
     * Validation Error Response
     */
    public static function validationError($errors): JsonResponse
    {
        return self::error(
            'Validation error',
            $errors,
            422
        );
    }

    /**
     * Unauthorized Response
     */
    public static function unauthorized(
        string $message = 'Unauthorized'
    ): JsonResponse {
        return self::error($message, null, 401);
    }

    /**
     * Forbidden Response
     */
    public static function forbidden(
        string $message = 'Forbidden'
    ): JsonResponse {
        return self::error($message, null, 403);
    }

    /**
     * Not Found Response
     */
    public static function notFound(
        string $message = 'Data not found'
    ): JsonResponse {
        return self::error($message, null, 404);
    }

    /**
     * Server Error Response
     */
    public static function serverError(
        string $message = 'Internal server error'
    ): JsonResponse {
        return self::error($message, null, 500);
    }
}
