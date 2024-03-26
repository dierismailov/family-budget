<?php

namespace App\Contracts;

use App\DTO\BudgetDTO;
use App\Models\Budget;
use Illuminate\Support\Collection;

interface IBudgetRepository
{
    public function getAllBudgetByUserId(int $user_id): Collection;

    public function getBudgetById(int $budget_id): ?Budget;

    public function storeBudgetByUser(BudgetDTO $budgetDTO, int $user_id): Budget;

    public function setLimit(int $limit, int $budget_id): bool;
}
