<?php

namespace App\Repositories;

use App\Contracts\IUserRepository;
use App\DTO\UserDTO;
use App\Http\Requests\PersonalAccessTokenRequest;
use App\Models\Budget;
use App\Models\BudgetMember;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;

class UserRepository implements IUserRepository
{

    public function getAllUsers(): Collection
    {
            return User::query()->get();
    }
    public function getUserById(int $userId): ?User
    {
        /**  @var User|null $user */
        $user = User::query()->find($userId);

        return $user;
    }

    public function createUser(UserDTO $userDTO): User
    {
         $user = new User();
         $user->name = $userDTO->getName();
         $user->surname = $userDTO->getSurname();
         $user->age = $userDTO->getAge();
         $user->birthday = $userDTO->getBirthday();
         $user->email = $userDTO->getEmail();
         $user->save();

         return  $user;
    }

    public function getUserByEmail(string $email): ?User {
        /** @var User|null $user */
        $user = User::query()->where('email', $email)->first();

        return  $user;
    }

    public function updateUserById(UserDTO $userDTO,  int $id): ?User
    {
        $user = User::query()->find($id);
        $user->name = $userDTO->getName();
        $user->surname = $userDTO->getSurname();
        $user->age = $userDTO->getAge();
        $user->birthday = $userDTO->getBirthday();
        $user->email = $userDTO->getEmail();
        $user->save();

        return  $user;
    }

    public function deleteUser(int $id):?User
    {
        return User::query()->find($id);
    }

    public function createUserToken(string $email, User $user): string
    {
        return $user->createToken(
            $email, ['server:update' ], now()->addSeconds(30)
        )->plainTextToken;
    }


    public function getUsersInBudget(int $budget_id): Collection
    {
        $budget = Budget::query()->find($budget_id);
         return $budget->users()->get();
    }
}
