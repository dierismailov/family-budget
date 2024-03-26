<?php

namespace App\Services\UserServices;

use App\Contracts\IRegisterRepository;
use App\Models\Register;

class RegisterService
{
    public function __construct(
        private IRegisterRepository $repository
    ){

    }


    public function execute(array $data): Register
    {

        return  $this->repository->createUserRegister($data);

    }
}
