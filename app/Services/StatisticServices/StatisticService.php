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
        $transactionsQuery = Transaction::query()->where('budget_id', $request->input('budget_id'))
            ->where('type', $request->input('transaction_type'));

        if ($request->input('type') == 'monthly') {
            $transactionsQuery->select([
                DB::raw('SUM(amount) as amount'),
                DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as date')
            ])->whereMonth('created_at', $requestDate->month)
                ->whereYear('created_at', $requestDate->year);
        } else if ($request->input('type') == 'yearly') {
            $transactionsQuery->select([
                DB::raw('SUM(amount) as amount'),
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as date')
            ])->whereYear('created_at', $requestDate->year);
        }

        // группируем продажы по дате
        $transactionsQuery = $transactionsQuery->groupBy('date');
        // нам нужно было отформотировать данные в виде "date:amount"
        $transactionsPluck = $transactionsQuery->pluck('amount', 'date');

        return $this->repository->chartFormatter($transactionsPluck,
        $request->input('type'),
        $requestDate
        );

    }
}
