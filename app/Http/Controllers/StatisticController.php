<?php

namespace App\Http\Controllers;

use App\Exceptions\ModelBudgetNotFoundException;
use App\Exceptions\TransactionsNotFoundException;
use App\Http\Requests\StatisticRequest\StatisticRequest;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\UserResource;
use App\Models\Transaction;
use App\Services\StatisticServices\StatisticService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StatisticController extends Controller
{
    /**
     * @throws ModelBudgetNotFoundException
     * @throws TransactionsNotFoundException
     */
    public function getStatistic(StatisticRequest $request, StatisticService $service): Application|View|\Illuminate\Foundation\Application|Factory
    {
        $validation = $request->validated();
        $chartData  = $service->execute($validation);
    return view('chart.google-chart',  compact('chartData'));
    }
}
