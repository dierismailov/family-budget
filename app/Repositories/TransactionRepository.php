<?php

namespace App\Repositories;

use App\Contracts\ITransactionRepository;
use App\Models\Transaction;
use Illuminate\Support\Collection;

class TransactionRepository implements ITransactionRepository
{

    public function getTransactionsByBudget(int $budget_id): Collection
    {

         return Transaction::query()->where('budget_id', $budget_id)->get();
    }

    public function getTransactionsByUser(int $user_id): Collection
    {
        return Transaction::query()->where('user_id', $user_id)->get();
    }
}
