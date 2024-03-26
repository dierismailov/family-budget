<?php

namespace App\Services\UserServices;

use App\Contracts\IUserRepository;
use App\Models\User;
use Illuminate\Support\Collection;

class UserService
{
    public function __construct(
        private IUserRepository $repository
    )
    {

    }

    /**
     * Получить всех пользователей.
     *
     * @return Collection
     */
    public function getAllUsers(): Collection
    {
        return $this->repository->getAllUsers();
    }

    /**
     * Получить пользователя по ID.
     *
     * @param int $user_id
     * @return User|null
     */
    public function getUserById(int $user_id): ?User
    {
        return $this->repository->getUserById($user_id);
    }

    public function getUsersInBudget(int $budget_id): Collection
    {
        return $this->repository->getUsersInBudget($budget_id);
    }
}
