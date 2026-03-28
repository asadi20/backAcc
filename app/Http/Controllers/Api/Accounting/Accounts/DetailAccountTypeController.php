<?php

namespace App\Http\Controllers\Api\Accounting\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Accounting\DetailAccountType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    public function show($id)
    {
        $detail = DetailAccountType::find($id);
        return response()->json([
            'success' => true,
            'message' => 'find requested detail account type by id',
            'data' => $detail,
            'meta' => [
                'timestamp' => now()
            ]
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

    public function update(Request $request, $id)
    {
        $detailAccountType = DetailAccountType::findOrFail($id);
        $validated = $request->validate([
            'code' => [
                'required',
                'max:10',
                Rule::unique('detail_account_types', 'code')->ignore($id)
            ],
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $detailUPD = $detailAccountType->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'requested row updated successfully',
            'data' => $detailUPD,
            'meta' => [
                'timestamp' => now()
            ]
        ]);
    }
}