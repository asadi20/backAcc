<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;

/**
 * FiscalYear Model
 *
 * Properties:
 * @property int $id
 * @property string $year_name
 * @property \Carbon\Carbon $start_date
 * @property \Carbon\Carbon $end_date
 * @property bool $is_current
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 *
 * Relations:
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Accounting\JournalEntry[] $journalEntries
 */

class FiscalYear extends Model
{
    //Columns allowed for mass assignment
    protected $fillable = [
        'year_name',
        'start_date',
        'end_date',
        'is_current',
    ];
    //Type casting for columns
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_current' => 'boolean',
    ];

    public function journalEntries()
    {
        return $this->hasMany(JournalEntry::class, 'fiscal_year_id');
    }

    /**
     * Scope: return only the current fiscal year
     */
    public function scopeCurrent($query)
    {
        return $query->where('is_current', true);
    }

    /**
     * Check if this fiscal year is the active one
     */
    public function isActive(): bool
    {
        return $this->is_current === true;
    }
}
