<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;

/**
 * Class JournalEntry
 *
 * @property int $id
 * @property int $fiscal_year_id
 * @property string $document_number
 * @property \Carbon\Carbon $entry_date
 * @property string|null $description
 * @property int $created_by
 * @property int $status
 * @property int $total_debit
 * @property int $total_credit
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class JournalEntry extends Model
{
    protected $fillable = [
        'fiscal_year_id',
        'document_number',
        'entry_date',
        'description',
        'created_by',
        'status',
        'total_debit',
        'total_credit',
    ];

    public function lines()
    {
        return $this->hasMany(JournalEntryLine::class);
    }

    public function fiscalYear()
    {
        return $this->belongsTo(FiscalYear::class, 'fiscal_year_id');
    }
}