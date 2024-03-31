<?php

namespace App\Services\BudgetServices;

use App\Contracts\IBudgetRepository;

class SetLimitForBudgetService
{
    public function __construct(
        private IBudgetRepository $repository
    )
    {

    }


    public function execute(int $limit, int $budget_id):bool
    {
        return $this->repository->setLimit($limit, $budget_id);
    }
}