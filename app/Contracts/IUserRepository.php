<?php

namespace App\Contracts;

use App\DTO\UserDTO;
use App\Exceptions\BusinessException;
use App\Models\Budget;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;

interface IUserRepository
{
    public function getAllUsers(): Paginator;

    public function getUserById( int $userId): ?User;

    public function createUser(UserDTO $userDTO): User;

    public function getUserByEmail(string $email): ?User;

    public function updateUserById(UserDTO $userDTO, User $user): User;

    public function deleteUser(int $id):bool;

    public function createUserToken(string $email, User $user): string;

    public function getUsersInBudget(int $budget_id): Paginator|AnonymousResourceCollection;

    public function addUserInBudget(int $budget_id, int $user_id): bool;

    public function sendEmailForUser(User $user, int $budget_id): bool;
}
