<?php

namespace App\Services\TransactionServices;

use App\Contracts\ITransactionRepository;
use App\DTO\TransactionDTO;
use App\Models\Transaction;

class StoreTransactionService
{
    public function __construct(
        private ITransactionRepository $repository
    )
    {

    }

    public function execute(TransactionDTO $transactionDTO): Transaction
    {
        return  $this->repository->newTransaction($transactionDTO);
    }

}
