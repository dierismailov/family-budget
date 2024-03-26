<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetMember extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'budget_member';
}
