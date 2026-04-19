<?php

namespace App\Http\Controllers\Api\Accounting\JournalEntries;

use App\Http\Controllers\Controller;
use App\Models\Accounting\JournalEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function store(Request $request)
    {

        $validated = $request->validate([
            'document_number' => 'required|string',
            'entry_date' => 'required|string',
            'description' => 'nullable|string',

            'lines' => 'required|array|min:1',
            'lines.*.account_id' => 'required|integer|exists:chart_of_accounts,id',
            'lines.*.detail_account_id' => 'nullable|integer|exists:detail_accounts,id',
            'lines.*.debit' => 'required|numeric|min:0',
            'lines.*.credit' => 'required|numeric|min:0',
            'lines.*.description' => 'nullable|string',
            'lines.*.line_order' => 'integer'
        ]);

        // create line order based on index number of input array
        foreach ($validated['lines'] as $index => &$line) {
            $line['line_order'] = $index + 1;
        }

        try {
            $journalEntry = DB::transaction(function () use ($validated) {
                // 1. create the journal entry
                $entry = JournalEntry::create([
                    'fiscal_year_id' => 1, // for current fiscla year
                    'document_number' => $validated['document_number'],
                    'entry_date' => $validated['entry_date'],
                    'description' => $validated['description'],
                    'created_by' => 1, // later get from Auth facade
                    'status' => 0,// for temp
                    'total_debit' => 0, // later sum debit
                    'total_credit' => 0, // later add sum of credits
                ]);
                // 2. create all lines
                $entryLines = $entry->lines()->createMany($validated['lines']);

                return $entry;
            });

            return response()->json([
                'success' => true,
                'message' => 'create new journal successfully',
                'data' => $journalEntry->load('lines'),
            ], 201);

        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create journal',
                'error' => $ex->getMessage()
            ], 500);
        }
    }
}
