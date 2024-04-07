<?php

namespace App\Contracts;

use App\DTO\BudgetDTO;
use App\Models\Budget;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;

interface IBudgetRepository
{
    public function getAll(): Paginator;

    public function getBudgetById( int $budget_id): ?Budget;
    public function getBudgetByIdForUser(int $user_id, int $budget_id): ?Budget;

    public function getAllBudgetByUserId(int $user_id): Paginator;

    public function storeBudgetByUser(BudgetDTO $budgetDTO, int $user_id): Budget;

    public function updateBudget(BudgetDTO $budgetDTO,Budget  $budget,  int $user_id): ?Budget;

    public function deleteBudget(int $budget_id): bool;
    public function setLimit(int $limit, int $budget_id): bool;
}
