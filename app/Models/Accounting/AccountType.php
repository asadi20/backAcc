<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property string $slug
 * @property string $name
 * @property int $sign
 * @property int $display_order
 * @property string $description
 * @property Carbon|null $created_at
 */
class AccountType extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug', // unique identifier, e.g. 'ASSET', 'LIABLITY'
        'name', // display name in desired language
        'sign', // +1 or -1 for balance calcuation
        'display_order', // sorting in UI
        'description' // optional explantion
    ];
}