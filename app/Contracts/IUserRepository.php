<?php

namespace App\Contracts;

use App\DTO\UserDTO;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

interface IUserRepository
{
    public function getAllUsers(): Collection;

    public function getUserById( int $userId): ?User;

    public function createUser(UserDTO $userDTO): User;

    public function getUserByEmail(string $email): ?User;

    public function updateUserById(UserDTO $userDTO, int $id): ?User;

    public function deleteUser(int $id):?User;

    public function createUserToken(string $email, User $user): string;

    public function getUsersInBudget(int $budget_id): Collection;
}
