<?php

namespace App\Services\UserServices;

use App\Contracts\IUserRepository;
use App\Exceptions\ModelUserNotFoundException;
use App\Models\User;

class GetUserByIdService
{
    public function __construct(
        private IUserRepository $repository
    )
    {

    }

    /**
     * Получить пользователя по ID.
     *
     * @param int $user_id
     * @return User|null
     * @throws ModelUserNotFoundException
     */
    public function execute(int $user_id): ?User
    {
        $user = $this->repository->getUserById($user_id);

        if ($user === null) {
            throw new ModelUserNotFoundException(__('message.user_not_found'), 403);
        }

        return $user;
    }
}
