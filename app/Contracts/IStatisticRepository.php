<?php

namespace App\Contracts;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

interface IStatisticRepository
{
    public function chart(int $budget_id, string $type): array;
}
