<?php

namespace App\Repositories;

use App\Contracts\IUserRepository;
use App\DTO\UserDTO;
use App\Exceptions\ModelBudgetNotFoundException;
use App\Exceptions\ModelUserNotFoundException;
use App\Http\Resources\UserResource;
use App\Jobs\AddUserInBudgetJob;
use App\Models\Budget;
use App\Models\BudgetUser;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRepository implements IUserRepository
{

    public function getAllUsers(): Paginator
    {
        return User::query()->simplePaginate(10);
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
        $user->email = $userDTO->getEmail();
        $user->password = Hash::make($userDTO->getPassword());
        $user->save();

        return $user;
    }

    public function getUserByEmail(string $email): ?User
    {
        /** @var User|null $user */
        $user = User::query()->where('email', $email)->first();

        return $user;
    }

    public function updateUserById(UserDTO $userDTO, User $user): User
    {
        $user->name = $userDTO->getName();
        $user->surname = $userDTO->getSurname();
        $user->email = $userDTO->getEmail();
        $user->password = $userDTO->getPassword();
        $user->verification = $userDTO->isVerification();
        $user->save();

        return $user;
    }

    public function deleteUser(int $id): bool
    {
        User::query()->find($id)->delete();
        return true;
    }

    public function createUserToken(string $email, User $user): string
    {
        return $user->createToken(
            $email, ['server:update'], now()->addSeconds(86400)
        )->plainTextToken;
    }


    /**
     * @throws ModelBudgetNotFoundException|ModelUserNotFoundException
     */
    public function getUsersInBudget(int $budget_id): Paginator|AnonymousResourceCollection
    {
        /** @var Budget|null $budget */
        $budget = Budget::query()->find($budget_id);

        if ($budget === null) {
            throw new ModelBudgetNotFoundException(__('message.budget_not-found'), 400);
        }

        $users = $budget->users()->get();

        if (count($users) === 0) {
            throw new ModelUserNotFoundException(__('message.empty'), 400);
        }

        return UserResource::collection($users);
    }

    public function addUserInBudget(int $budget_id, int $user_id): bool
    {

        $record = new BudgetUser();
        $record->user_id = $user_id;
        $record->budget_id = $budget_id;
        $record->save();

        return true;
    }

    public function sendEmailForUser(User $user, int $budget_id): bool
    {
        $token = Str::random(60);

        /** @var User|null $user */
        $user->confirmation_token = $token;
        $user->save();


        AddUserInBudgetJob::dispatch($user, $budget_id, $token);

        return true;
    }
}
