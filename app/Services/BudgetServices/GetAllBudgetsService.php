<?php

namespace App\Services\BudgetServices;

use App\Contracts\IBudgetRepository;
use App\Exceptions\BusinessException;
use Illuminate\Contracts\Pagination\Paginator;

class GetAllBudgetsService
{
    public function __construct(
        private IBudgetRepository $repository
    )
    {

    }

    public function execute(): Paginator
    {
        return $this->repository->getAll();
    }
}
