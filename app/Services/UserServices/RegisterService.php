<?php

namespace App\Services\UserServices;

use App\Contracts\IRegisterRepository;
use App\Models\Register;
use App\Models\User;

class RegisterService
{
    public function __construct(
        private IRegisterRepository $repository
    ){

    }


    public function execute(array $data): ?User
    {

        return  $this->repository->createUserRegister($data);

    }
}
