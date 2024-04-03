<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property int $budget_id
 * @property int $amount
 * @property string $category
 * @property string $type
 */

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'budget_id',
        'amount',
        'category',
        'type'
    ];

    public function familyBudget(): BelongsTo
    {
        return $this->belongsTo(Budget::class);
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
