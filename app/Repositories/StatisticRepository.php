<?php

namespace App\Repositories;

use App\Contracts\IStatisticRepository;
use App\Exceptions\BusinessException;
use App\Exceptions\TransactionsNotFoundException;
use App\Models\Budget;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class StatisticRepository implements IStatisticRepository
{
    /**
     * @throws TransactionsNotFoundException
     */
    public function chart(int $budget_id, string $type): array
    {
        $currentYear = Carbon::now()->year;
        $transactions = Transaction::query()->where('budget_id', $budget_id)
            ->where('type', $type)
            ->whereYear('created_at', $currentYear)
            ->get();
        if (count($transactions) === 0) {
            throw new TransactionsNotFoundException(__('message.transactions_not_found'), 403);
        }

        $transactionsByMonth = $transactions->groupBy(function ($transaction) {
            return $transaction->created_at->format('M');
        });

        $sumsByMonth = [];

        foreach ($transactionsByMonth as $month => $transactions) {
            $sumsByMonth[$month] = $transactions->sum('amount');
        }
        $data = [];
        $data[]  = ['Month' , ucwords($type)];

        foreach ($sumsByMonth as $key => $value){
            $data[]= [$key , $value];
        }

        return $data;

    }

    public  function chartFormatter(Collection $collection, string $type, Carbon $requestDate): Collection
    {
        $startDate = 0;
        $count = 0;
        if ($type === "monthly") {
            $startDate = $requestDate->startOfMonth();
            $count = $requestDate->daysInMonth;
        } elseif ($type === "yearly") {
            $startDate = $requestDate->startOfYear();
            $count = 12;
        }


        for ($i = 0; $i < $count; $i++) {
            $currDate = $startDate->copy();

            $date = null;
            if ($type === "monthly") {
                $date = $currDate->addDays($i)->format("Y-m-d");
            } elseif ($type === "yearly") {
                $date = $currDate->addMonth($i)->format("Y-m");
            }


            if ($collection->has($date) === false) {
                $collection->put($date, 0);
            }
        }


        return $collection->sortKeys();
    }
}
