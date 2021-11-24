<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param $data
     * @return JsonResponse
     */
    public function fail($data = []): JsonResponse
    {
        $response = [
            'data' => $data,
            'status' => 'fail',
        ];
        return response()->json($response, 400);
    }

    /**
     * @param $data
     * @return JsonResponse
     */
    public function success($data = []): JsonResponse
    {
        $response = [
            'data' => $data,
            'status' => 'success',
        ];
        return response()->json($response, 200);
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public function error(string $message = ''): JsonResponse
    {
        $response = [
            'message' => $message,
            'status' => 'error',
        ];
        return response()->json($response, 500);
    }
}
