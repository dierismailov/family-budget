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
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class StatisticService
{
    public function __construct(
        private IStatisticRepository $repository
    )
    {

    }


    public function execute(StatisticRequest $request): Collection
    {
        $requestDate = Carbon::make($request->input('request_date'));

        $transactionsPluck = $this->repository->getDataForChart($request, $requestDate);

        return $this->repository->chartFormatter($transactionsPluck,
        $request->input('type'),
        $requestDate
        );

    }
}
