<?php

namespace App\Services\BudgetServices;

use App\Contracts\IBudgetRepository;
use App\DTO\BudgetDTO;
use App\Models\Budget;

class CreateBudgetService
{
    public function __construct(
        private IBudgetRepository $repository
    )
    {

    }


    public function execute(BudgetDTO $budgetDTO, int $user_id): ?Budget
    {
        return $this->repository->storeBudgetByUser($budgetDTO, $user_id);
    }

}
