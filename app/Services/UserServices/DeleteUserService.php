<?php

namespace App\Services\UserServices;

use App\Contracts\IUserRepository;
use App\Exceptions\BusinessException;

class DeleteUserService
{
    public function __construct(
        private IUserRepository $repository
    ){

    }

    /**
     * @throws BusinessException
     */
    public function execute(int $user_id): void
    {
        $user = $this->repository->getUserById($user_id);
        if ($user === null) {
            throw new BusinessException(__('message.user_not_found'), 400);
        }
         $this->repository->deleteUser($user_id);
    }
}
