<?php

namespace App\Contracts;

use App\DTO\TransactionDTO;
use App\Models\Transaction;
use Illuminate\Support\Collection;

interface ITransactionRepository
{
    public function getTransactionsByBudget(int $budget_id): Collection ;
    public function getTransactionsByUser(int $user_id): Collection ;

    public function newTransaction(TransactionDTO $transactionDTO): Transaction;
}
