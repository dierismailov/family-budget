<?php

namespace App\Services\TransactionServices;

use App\Contracts\ITransactionRepository;
use Illuminate\Support\Collection;

class TransactionService
{
    public function __construct(
        private ITransactionRepository $repository
    )
    {

    }

    public function getTransactionByBudget(int $budget_id): Collection
    {
        return $this->repository->getTransactionsByBudget($budget_id);
    }

    public function getTransactionByUser(int $user_id): Collection
    {
        return $this->repository->getTransactionsByUser($user_id);
    }
}
