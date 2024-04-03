<?php

namespace App\Contracts;

use App\Models\Budget;
use App\Models\User;

interface IStatisticRepository
{
    public function chart(User $user, Budget $budget);
}
