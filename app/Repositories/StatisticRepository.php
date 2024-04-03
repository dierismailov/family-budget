<?php

namespace App\Repositories;

use App\Contracts\IStatisticRepository;
use App\Models\Budget;
use App\Models\User;

class StatisticRepository implements IStatisticRepository
{
    public function chart(User $user, Budget $budget)
    {
        return $user;
    }
}
