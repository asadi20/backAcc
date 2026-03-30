<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;

/**
 * Class JournalEntryLine
 *
 * @property int $id
 * @property int $journal_entry_id
 * @property int $account_id
 * @property int $detail_account_id
 * @property int $debit
 * @property int $credit
 * @property string|null $line_description
 * @property int $line_order
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property-read JournalEntry $journalEntry
 * @property-read ChartOfAccount $account
 * @property-read DetailAccount $detailAccount
 */
class JournalEntryLine extends Model
{
     protected $fillable = [
        'journal_entry_id',
        'account_id',
        'detail_account_id',
        'debit',
        'credit',
        'line_description',
        'line_order',
    ];

    protected $casts = [
        'journal_entry_id' => 'integer',
        'account_id'       => 'integer',
        'detail_account_id'=> 'integer',
        'debit'            => 'integer',
        'credit'           => 'integer',
        'line_order'       => 'integer',
        'created_at'       => 'datetime',
        'updated_at'       => 'datetime',
    ];

    //Relationships

    public function journalEntry()
    {
        return $this->belongsTo(JournalEntry::class, 'journal_entry_id');
    }

    public function account()
    {
        return $this->belongsTo(ChartOfAccount::class, 'account_id');
    }

    public function deatilAccount()
    {
        return $this->belongsTo(DetailAccount::class, 'detail_account_id');
    }
}
