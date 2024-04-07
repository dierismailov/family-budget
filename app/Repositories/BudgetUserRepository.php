<?php

namespace App\Repositories;

use App\Contracts\IBudgetUserRepository;
use App\Models\BudgetUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class BudgetUserRepository implements IBudgetUserRepository
{

    public function checkExistByUserIdAndBudgetId(int $user_id, int $budget_id): Builder|Collection
    {
        return  BudgetUser::query()->where('user_id', $user_id)->where('budget_id', $budget_id)->get();
    }
}
