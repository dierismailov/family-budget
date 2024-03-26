<?php

namespace App\Services\UserServices;

use App\Contracts\IUserRepository;
use Illuminate\Support\Collection;

class GetAllUsersService
{
    public function __construct(
        private IUserRepository $repository
    )
    {

    }


}

