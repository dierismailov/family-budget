<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface ITransactionRepository
{
    public function getTransactionsByBudget(int $budget_id): Collection ;
    public function getTransactionsByUser(int $user_id): Collection ;
}
