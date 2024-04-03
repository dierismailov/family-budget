<?php

namespace App\Services\TransactionServices;

use App\Contracts\ITransactionRepository;
use Illuminate\Support\Collection;

class getTransactionByBudgetService
{
    public function __construct(
        private ITransactionRepository $repository
    )
    {

    }

    public function execute(int $budget_id): Collection
    {
        return $this->repository->getTransactionsByBudget($budget_id);
    }
}
