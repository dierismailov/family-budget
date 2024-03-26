<?php

namespace App\Services\BudgetServices;

use App\Contracts\IBudgetRepository;
use App\DTO\BudgetDTO;
use App\Models\Budget;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class BudgetService
{
    public function __construct(
        private IBudgetRepository $repository
    )
    {

        }

    public function getAllBudgetByUserId(int $user_id): Collection
    {
        return $this->repository->getAllBudgetByUserId($user_id);
    }

    public function addBudget(BudgetDTO $budgetDTO, int $user_id): ?Budget
    {
        return $this->repository->storeBudgetByUser($budgetDTO, $user_id);
    }

    public function setLimit(int $limit, int $budget_id):bool
    {
        return $this->repository->setLimit($limit, $budget_id);
    }
}
