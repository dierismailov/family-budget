<?php

namespace App\Services\UserServices\AuthService;

use App\Contracts\IUserRepository;
use App\DTO\UserDTO;
use App\Exceptions\BusinessException;
use App\Jobs\SendCodeForRegister;
use Illuminate\Support\Facades\Cache;

class RegisterService
{
    public function __construct(
        private IUserRepository $repository
    ){

    }


    /**
     * @throws BusinessException
     */
    public function execute(UserDTO $userDTO): void
    {

        $userExist = $this->repository->getUserByEmail($userDTO->getEmail());

        if ($userExist !== null) {
            throw new BusinessException(__('message.exists_user'), 409);
        }

        $user = $this->repository->createUser($userDTO);

        $randNum = rand(100000, 999999);
        Cache::put('data-for-register' , ['email' => $userDTO->getEmail(), 'code' => $randNum,], 300 );

        SendCodeForRegister::dispatch($user, $randNum);

    }
}
