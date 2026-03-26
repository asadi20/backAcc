<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;

class DetailAccountType extends Model
{
    public function detailAccounts()
    {
        return $this->hasMany(DetailAccount::class, 'type_id');
    }
}
