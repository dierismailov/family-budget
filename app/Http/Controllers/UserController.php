<?php

namespace App\Http\Controllers;

use App\Contracts\IUserRepository;
use App\DTO\UserDTO;
use App\Exceptions\BusinessException;
use App\Exceptions\ModelBudgetNotFoundException;
use App\Exceptions\ModelUserNotFoundException;
use App\Http\Requests\UserRequests\ConfirmEmailRequest;
use App\Http\Requests\UserRequests\InputUserRequest;
use App\Http\Requests\UserRequests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserServices\AddUserInBudgetService;
use App\Services\UserServices\CheckUserForAddService;
use App\Services\UserServices\DeleteUserService;
use App\Services\UserServices\GetAllUsersService;
use App\Services\UserServices\GetUserByIdService;
use App\Services\UserServices\UpdateUserService;
use App\Services\UserServices\UserService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    public function __construct(protected IUserRepository $repository)
    {

    }


    public function index(GetAllUsersService $service): AnonymousResourceCollection
    {
        $users = $service->execute();

        return UserResource::collection($users);
    }

    /**
     * @throws ModelUserNotFoundException
     */
    public function show(GetUserByIdService $service, int $user_id): ?User
    {
        return $service->execute($user_id);
    }

    /**
     * @throws BusinessException
     */
    public function update(UpdateUserService $service, StoreUserRequest $request, int $user_id): UserResource
    {
        $validated = $request->validated();
        $user = $service->execute(UserDTO::fromArray($validated), $user_id);

        return new UserResource($user);
    }


    /**
     * @throws BusinessException
     */
    public function destroy(DeleteUserService $service, int $user_id): BusinessException
    {
        $service->execute($user_id);

        throw new BusinessException(__('message.user_deleted'), 200);
    }
    /**
     * Получить пользователей, связанных с бюджетом.
     *
     * @param UserService $service
     * @param int $budget_id
     * @return AnonymousResourceCollection
     */
    public function getUsersInBudget(UserService $service, int $budget_id): AnonymousResourceCollection
    {

        $users = $service->getUsersInBudget($budget_id);

        return UserResource::collection($users);

    }

    /**
     * @param CheckUserForAddService $service
     * @param int $budget_id
     * @param InputUserRequest $request
     * @return string
     * @throws BusinessException
     * @throws ModelUserNotFoundException
     * @throws ModelBudgetNotFoundException
     */
    public function addUsersInBudget(CheckUserForAddService $service, int $budget_id, InputUserRequest $request): string
    {
        return $service->execute($budget_id, $request);
    }

    /**
     * @throws BusinessException
     * @throws ModelBudgetNotFoundException
     * @throws ModelUserNotFoundException
     */
    public function confirmForAddBudget(ConfirmEmailRequest $request, AddUserInBudgetService $service): BusinessException
    {
        return $service->execute($request);
    }

}
