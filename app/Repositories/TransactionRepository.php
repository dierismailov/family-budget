<?php

namespace App\Repositories;

use App\Contracts\ITransactionRepository;
use App\DTO\TransactionDTO;
use App\Jobs\SumTransactionLimitBudgetJob;
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


    public function newTransaction(TransactionDTO $transactionDTO): Transaction
    {
         $transaction = new Transaction();
         $transaction->user_id = $transactionDTO->getUserId();
         $transaction->budget_id = $transactionDTO->getBudgetId();
         $transaction->amount = $transactionDTO->getAmount();
         $transaction->category = $transactionDTO->getCategory();
         $transaction->type = $transactionDTO->getType();
         $transaction->save();

         SumTransactionLimitBudgetJob::dispatch($transaction);

         return $transaction;
    }
}
