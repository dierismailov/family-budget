<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatisticRequest\StatisticRequest;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\UserResource;
use App\Services\StatisticServices\StatisticService;

class StatisticController extends Controller
{
    public function getStatistic( StatisticRequest $request, StatisticService $service): TransactionResource
    {
        $validation = $request->validated();
        $user = $service->execute($validation);
        return $user;

    }
}
