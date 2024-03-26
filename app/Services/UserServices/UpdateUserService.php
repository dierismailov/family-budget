<?php

namespace App\Services\UserServices;

use App\Contracts\IUserRepository;
use App\DTO\UserDTO;
use App\Exceptions\BusinessException;
use App\Models\User;

class UpdateUserService
{
    public function __construct(
        private IUserRepository $repository
    )
    {

    }

    /**
     * @throws BusinessException
     */
    public function execute(UserDTO $userDTO, int $id): User
    {
        $user = $this->repository->getUserById($id);
        if ($user === null) {
            throw new BusinessException(__('message.user_not_found'), 400);
        }

        return $this->repository->updateUserById($userDTO, $id);

    }
}
