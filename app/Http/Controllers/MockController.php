<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MockController extends Controller
{
    public function getResponse(Request $request): JsonResponse
    {
        $status = $request->header('X-Mock-Status');

        if ($status === 'accepted') {
            return response()->json(['status' => 'accepted'], 200);
        } elseif ($status === 'failed') {
            return response()->json(['status' => 'failed'], 400);
        }

        return response()->json(['error' => 'Invalid mock status'], 400);
    }
}
