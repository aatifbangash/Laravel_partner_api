<?php

namespace App\Http\Traits;

trait ResponseTrait {
    public function error($data, $statusCode = 400) {
        return response()->json([
            'status' => 'error',
            'message' => $data
        ], $statusCode);
    }

    public function success($data, $statusCode = 200) {
        return response()->json([
            'status' => 'success',
            'data' => $data
        ], $statusCode);
    }
}