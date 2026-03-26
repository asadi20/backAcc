<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;

class DetailAccount extends Model
{
    public function type()
    {
        return $this->belongsTo(DetailAccountType::class, 'type_id');
    }

}
