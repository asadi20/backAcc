<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
/**
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int $level
 * @property int $account_type_id
 * @property int|null $parent_id
 */
class ChartOfAccount extends Model
{
    protected $fillable = [
        'code',
        'name',
        'level',
        'account_type_id',
        'parent_id'
    ];

    public function lines()
    {
        return $this->hasMany(JournalEntryLine::class);
    }

    public function detailAccountTypes()
    {
        return $this->belongsToMany(DetailAccountType::class, 'coa_detail_types','account_id','type_id');
    }
}
