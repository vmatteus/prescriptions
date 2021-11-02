<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function requestResponse($data) {
        return response()->json([
            'data' => $data
        ]);
    }

    public function requestResponseError(\Exception $e) {
        return response()->json([
            'error' => [
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ]
        ]);
    }
}
