<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string|null $description
 */
class DetailAccountType extends Model
{
    protected $fillable = [
        'code',
        'name',
        'description'
    ];
    public function detailAccounts()
    {
        return $this->hasMany(DetailAccount::class, 'type_id');
    }
}
