<?php

namespace App\Services\UserServices;

use App\Contracts\IUserRepository;

class AddUserInBudgetService
{
    public function __construct(
        private IUserRepository $repository
    )
    {

    }

    public function execute()
    {

    }
}
