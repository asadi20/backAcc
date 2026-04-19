<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
/**
 * @property int $id
 * @property int $account_id
 * @property int $type_id
 */
class CoaDetailType extends Model
{
    protected $table = 'coa_detail_types';
    protected $fillable = [
        'account_id',
        'type_id'
    ];

    public $timestamps = true;

    public function account()
    {
        return $this->belongsTo(ChartOfAccount::class,'account_id');
    }

    public function detail_type()
    {
        return $this->belongsTo(DetailAccountType::class, 'type_id');
    }
}
