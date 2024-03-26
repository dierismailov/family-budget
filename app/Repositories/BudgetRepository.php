<?php

namespace App\Repositories;

use App\Contracts\IBudgetRepository;
use App\DTO\BudgetDTO;
use App\Models\Budget;
use Illuminate\Support\Collection;

class BudgetRepository implements IBudgetRepository
{
    /**
     * Получить все бюджеты для указанного пользователя.
     *
     * @param int $user_id
     * @return Collection
     */
        public function getAllBudgetByUserId(int $user_id): Collection
    {
        return Budget::query()->where('creator_id', $user_id)->get();
    }

    public function getBudgetById(int $budget_id): ?Budget
    {
        return Budget::query()->find($budget_id);
    }

    public function storeBudgetByUser(BudgetDTO $budgetDTO, int $user_id): Budget
    {

    {
        $budget = new Budget();
        $budget->name = $budgetDTO->getName();
        $budget->creator_id = $user_id;
        $budget->status = 'none';
        $budget->save();

        return  $budget;
    }
    }

    public function setLimit(int $limit, int $budget_id): bool
    {
         $budget = Budget::query()->find($budget_id);
         $budget->limit = $limit;

         return true;
    }
}
