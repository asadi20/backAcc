<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
/**
 * Class DetailAccount
 * 
 * @property int $id
 * @property string $name
 * @property int $code
 * @property int $type_id
 * @property string|null $national_id
 * @property string|null $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property DetailAccountType $type
 * 
 */
class DetailAccount extends Model
{
    protected $fillable =[
        'name',
        'code',
        'type_id',
        'national_id',
        'description',
    ];
    public function type()
    {
        return $this->belongsTo(DetailAccountType::class, 'type_id');
    }

    public function lines()
    {
        return $this->hasMany(JournalEntryLine::class);
    }

}
