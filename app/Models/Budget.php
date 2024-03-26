<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use mysql_xdevapi\Table;

/**
 * @property int $id
 * @property string $name
 * @property int $creator_id
 * @property string $status
 */
class Budget extends Model
{
    use HasFactory;

    protected $table = 'family_budgets';

    protected $fillable = [
        'name',
        'creator_id',
        'status'
    ];
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'budget_member');
    }

    public function transaction(): hasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
