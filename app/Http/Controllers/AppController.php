<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    protected function response(array $response, int $status): \Illuminate\Http\JsonResponse
    {
        return response()->json($response, $status);
    }
}
