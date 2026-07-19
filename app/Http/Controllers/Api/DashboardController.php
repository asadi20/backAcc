<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function stats()
    {
        return response()->json([
            "success" => true,
            'message' => 'Dashboard status retrieved successfully.',
            'data' => [
                'user' => [
                    'title' => 'users',
                    'amount' => 12,
                ],
                'sell' => [
                    'title' => 'sell amount',
                    'amount' => 200,
                ],
                'document' => [
                    'title' => 'Document quantity',
                    'amount' => 124
                ],
                'employee' => [
                    'title' => 'Employee Stats',
                    'amount' => 8
                ]
            ],
        ], 200);
    }
}
