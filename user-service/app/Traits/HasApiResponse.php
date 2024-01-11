<?php

namespace App\Traits;

trait HasApiResponse
{
    public function successResponse($data, $message = null, $code = 200)
    {
        return response()->json([
            'status'    => 'success',
            'message'   => $message,
            'data'      => $data
        ], $code);
    }

    public function errorResponse($message, $code = 400)
    {
        return response()->json([
            'status'    => 'error',
            'message'   => $message
        ], $code);
    }

    public function serviceSuccessResponse($data, $message = null, $code = 200)
    {
        return response()->json([
            'status'    => 'success',
            'message'   => $message,
            'data'      => $data
        ], $code)->header('Content-Type', 'application/json');
    }

    public function serviceErrorResponse($message, $code = 400)
    {
        return response()->json([
            'status'    => 'error',
            'message'   => $message
        ], $code)->header('Content-Type', 'application/json');
    }
}
