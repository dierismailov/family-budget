<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @property int $id
 * @property int $user_id
 * @property int $budget_id
 */
class BudgetUser extends Model
{
    use HasFactory;

    public $timestamps = false;
    /**
     * @var int|mixed
     */


    protected $table = 'budget_user';
}
