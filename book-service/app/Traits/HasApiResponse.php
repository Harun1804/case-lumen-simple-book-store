<?php

namespace App\Traits;

trait HasApiResponse
{
    public function successResponse($data, $message = null, $code = 200)
    {
        return response()->json([
            $data
        ], $code);
    }

    public function errorResponse($message, $code = 400)
    {
        return response()->json([
            'message'   => $message
        ], $code);
    }
}
