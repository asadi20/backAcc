<?php
namespace App\Http\Controllers\Api\Accounting\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Accounting\ChartOfAccount;

class ChartOfAccountController extends Controller
{
    public function index()
    {

    }

    public function getAllSubLedger()
    {
        // subLedger level = 2
        $COA = ChartOfAccount::where('level', 2)->get();
        return response()->json([
            'success' => true,
            'message' => 'all Sub Ledgers retrived successfully.',
            'data' => $COA,
            'meta' => [
                'count' => $COA->count(),
                'timestamp' => now()
            ],
        ], 200);
    }
}