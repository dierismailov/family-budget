<?php

namespace App\Services\BudgetServices;

use App\Contracts\IBudgetRepository;
use App\Exceptions\BusinessException;

class SetLimitForBudgetService
{
    public function __construct(
        private IBudgetRepository $repository
    )
    {

    }



    public function execute(int $limit, int $budget_id):bool
    {
        $this->repository->setLimit($limit, $budget_id);
        return true;
    }
}
