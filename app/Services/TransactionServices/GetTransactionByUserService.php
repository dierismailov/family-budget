<?php

namespace App\Services\TransactionServices;

use App\Contracts\ITransactionRepository;
use Illuminate\Support\Collection;

class GetTransactionByUserService
{
    public function __construct(
        private ITransactionRepository $repository
    )
    {

    }

    public function execute(int $user_id): Collection
    {
        return $this->repository->getTransactionsByUser($user_id);
    }
}
