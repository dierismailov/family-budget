<?php

namespace App\Contracts;

use App\Http\Requests\StatisticRequest\StatisticRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

interface IStatisticRepository
{
    public function chart(int $budget_id, string $type): array;

    public function chartFormatter(Collection $collection, string $type, Carbon $requestDate): Collection;

    public function getDataForChart(StatisticRequest $request, Carbon $requestDate);
}
