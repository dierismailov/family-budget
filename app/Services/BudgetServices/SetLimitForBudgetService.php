<?php

namespace App\Services\BudgetServices;

use App\Contracts\IBudgetRepository;
use App\Exceptions\BusinessException;
use Illuminate\Support\Facades\Bus;

class SetLimitForBudgetService
{
    public function __construct(
        private IBudgetRepository $repository
    )
    {

    }


    /**
     * @throws BusinessException
     */
    public function execute(array $limit, int $budget_id):BusinessException
    {
        $result = $this->repository->setLimit($limit['limit'], $budget_id);
        if ($result){
            throw new BusinessException(__('message.limit_set'), 200);
        } else {

            throw new BusinessException(__('message.limit_not_set'), 400);
        }
    }
}
