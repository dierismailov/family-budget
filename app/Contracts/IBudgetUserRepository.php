<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface IBudgetUserRepository
{
    public function checkExistByUserIdAndBudgetId(int $user_id, int $budget_id): Builder|Collection;
}
