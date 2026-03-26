<?php

namespace App\Http\Controllers\Api\Accounting\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Accounting\DetailAccountType;
use Illuminate\Http\Request;

class DetailAccountTypeController extends Controller
{
    public function index()
    {
        $details = DetailAccountType::all();
        return response()->json([
            'success' => true,
            'message' => 'all detail account types retrived successfully.',
            'data' => $details,
            'meta' => [
                'count' => $details->count(),
                'timestamp' => now()
            ],
        ], 200);
    }
    public function store(Request $request)
    {
        // validation
        $validated = $request->validate([
            'code' => 'required|max:10|unique:detail_account_types,code',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        // create record
        $detailAccountType = DetailAccountType::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Detail account type created successfully.',
            'data' => $detailAccountType,
            'meta' => [
                'id' => $detailAccountType->id,
                'timestamp' => now()
            ]
        ], 201);

    }
}