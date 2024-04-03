<?php

namespace App\Services\StatisticServices;

use App\Contracts\IStatisticRepository;
use App\Exceptions\ModelBudgetNotFoundException;
use App\Exceptions\ModelUserNotFoundException;
use App\Exceptions\TransactionsNotFoundException;
use App\Http\Requests\StatisticRequest\StatisticRequest;
use App\Models\Budget;
use App\Models\Transaction;
use App\Models\User;

class StatisticService
{
    public function __construct(
        private IStatisticRepository $repository
    )
    {

    }

    /**
     * @throws ModelBudgetNotFoundException
     * @throws TransactionsNotFoundException
     */
    public function execute(array $array): array
    {
        $budget_id = $array['budget_id'];
        $type = $array['type'];
        $budget = Budget::query()->find($budget_id);

        if ($budget === null) {
            response()->json(__('message.budget_not_found'), 403);
        }

//
        return $this->repository->chart($budget_id, $type);

    }
}
