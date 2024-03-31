<?php

namespace App\Services\UserServices;

use App\Contracts\IUserRepository;
use App\Exceptions\ModelUserNotFoundException;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;

class UserService
{
    public function __construct(
        private IUserRepository $repository
    )
    {

    }


    public function getUsersInBudget(int $budget_id): AnonymousResourceCollection
    {
        return $this->repository->getUsersInBudget($budget_id);
    }
}
