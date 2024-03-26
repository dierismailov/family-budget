<?php

namespace App\Services\UserServices;

use App\Contracts\IUserRepository;
use App\DTO\UserDTO;
use App\Exceptions\BusinessException;
use App\Models\User;

class CreateUserService
{
    public function __construct(
        private IUserRepository $repository
    )
    {

    }

    /**
     * @throws BusinessException
     */
    public function execute(UserDTO $userDTO): User
    {
        $userWithEmail = $this->repository->getUserByEmail($userDTO->getEmail());
        if ($userWithEmail !== null) {
            throw new BusinessException(__('message.exists_user'), 403);
        }

        return $this->repository->createUser($userDTO);

    }
}
