<?php

namespace App\Services\BudgetServices;

use App\Contracts\IBudgetRepository;
use App\DTO\BudgetDTO;
use App\Exceptions\ModelBudgetNotFoundException;
use App\Models\Budget;

class UpdateBudgetService
{
    public function __construct(
        private IBudgetRepository $repository
    )
    {

    }

    /**
     * @throws ModelBudgetNotFoundException
     */
    public function execute(BudgetDTO $budgetDTO, int $budget_id, int $user_id): ?Budget
    {
        $budget = $this->repository->getBudgetById($user_id, $budget_id);

        if ($budget === null) {
            throw new ModelBudgetNotFoundException(__('message.budget_not_found'), 403);
        }

        return $this->repository->updateBudget($budgetDTO, $budget, $user_id);
    }

}
