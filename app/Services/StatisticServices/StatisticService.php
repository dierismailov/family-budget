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
    public function execute(array $array)
    {
        $budget_id = $array['budget_id'];
        $budget = Budget::query()->find($budget_id);

        if ($budget === null) {
            throw new ModelBudgetNotFoundException(__('message.budget_not_found'), 403);
        }
        $transaction = Transaction::query()->where('budget_id', $budget_id)->get();

        if (count($transaction) === 0) {
            throw new TransactionsNotFoundException(__('message.transactions_not_found'), 403);
        }
//        dd(now('Asia/Tashkent'));
          return  $this->repository->chart($user, $budget);


    }
}
