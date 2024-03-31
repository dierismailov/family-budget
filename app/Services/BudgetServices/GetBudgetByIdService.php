<?php

namespace App\Services\BudgetServices;

use App\Contracts\IBudgetRepository;
use App\Exceptions\ModelBudgetNotFoundException;
use App\Exceptions\ModelUserNotFoundException;
use App\Models\Budget;
use App\Models\User;

class GetBudgetByIdService
{
    public function __construct(
        private IBudgetRepository $repository
    )
    {

    }

    /**
     * @throws ModelBudgetNotFoundException
     * @throws ModelUserNotFoundException
     */
    public function execute(int $user_id, int $budget_id): ?Budget
    {
        $user = User::query()->find($user_id);

        if ($user === null) {
            throw new ModelUserNotFoundException(__('message.user_not_found'), 403);
        }

        $budget = $this->repository->getBudgetById($user_id, $budget_id);

        if ($budget === null) {
            throw new ModelBudgetNotFoundException(__('message.budget_not_found'), 403);
        }

        return  $budget;
    }
}
