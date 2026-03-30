<?php

namespace App\Http\Controllers\Api\Accounting\JournalEntries;

use App\Http\Controllers\Controller;
use App\Models\Accounting\JournalEntry;
use Illuminate\Http\Request;

class JournalEntryController extends Controller
{
    public function index()
    {
        $journals = JournalEntry::all();
        return response()->json([
            'success' => true,
            'message' => 'all detail accounts retrived successfully.',
            'data' => $journals,
            'meta' => [
                'count' => $journals->count(),
                'timestamp' => now()
            ],
        ], 200);
    }
}
