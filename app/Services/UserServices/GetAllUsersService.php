<?php

namespace App\Services\UserServices;

use App\Contracts\IUserRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;

class GetAllUsersService
{
    public function __construct(
        private IUserRepository $repository
    )
    {

    }

    public function execute(): Paginator
    {
        return $this->repository->getAllUsers();
    }

}

