<?php

namespace App\Http\Controllers\Api\Accounting\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Accounting\ChartOfAccount;
use App\Models\Accounting\DetailAccount;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DetailAccountController extends Controller
{
    public function index()
    {
        // get type_name with relation and flatten with map for easy use in front
        $details = DetailAccount::with('type')->get()->map(function ($item) {
            $item->type_name = $item->type?->name;
            return $item;
        });

        return response()->json([
            'success' => true,
            'message' => 'all detail accounts retrived successfully.',
            'data' => $details,
            'meta' => [
                'count' => $details->count(),
                'timestamp' => now()
            ],
        ], 200);

    }

    public function show($id)
    {
        $detail = DetailAccount::with('type')->findOrFail($id);
        $detail->type_name = $detail->type?->name;
        return response()->json([
            'success' => true,
            'message' => 'detail account retrived successfully.',
            'data' => $detail,
            'meta' => [
                'timestamp' => now()
            ],
        ], 200);

    }

    public function store(Request $request)
    {
        // validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|max:10|unique:detail_account_types,code',
            'type_id' => 'required|max:20',
            'national_id' => 'nullable|string',
            'description' => 'nullable|string'
        ]);

        // create record
        $detailAccount = DetailAccount::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Detail account type created successfully.',
            'data' => $detailAccount,
            'meta' => [
                'id' => $detailAccount->id,
                'timestamp' => now()
            ]
        ], 201);
    }

    public function update($id, Request $request)
    {
        $detailAccount = DetailAccount::findOrFail($id);
        $validated = $request->validate([
            'code' => ['required', 'max:10', Rule::unique('detail_accounts', 'code')->ignore($id)],
            'name' => 'required|string|max:255',
            'type_id' => 'required|max:20',
            'national_id' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255'
        ]);

        $detailUPD = $detailAccount->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'requested row updated successfully',
            'data' => $detailUPD,
            'meta' => [
                'timestamp' => now()
            ]
        ]);

    }

    public function getBySubLedger($subLedgerId)
    {
        $type_ids = ChartOfAccount::where('level', 2)
            ->with('detailAccountTypes')
            ->findOrFail($subLedgerId)
            ->detailAccountTypes()
            ->pluck('coa_detail_types.id');

        $details = DetailAccount::whereIn('type_id', $type_ids)->get();

        return response()->json([
            'success' => true,
            'message' => 'detail accounts by subLedgerId retrived successfully.',
            'data' => $details,
            'meta' => [
                'timestamp' => now()
            ]
        ]);
    }
}
