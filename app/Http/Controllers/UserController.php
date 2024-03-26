<?php

namespace App\Http\Controllers;

use App\Contracts\IUserRepository;
use App\Http\Requests\UserRequest;
use App\Http\Resources\BudgetResource;
use App\Http\Resources\UserResource;
use App\Jobs\SendCodeForRegister;
use App\Models\User;
use App\Services\UserServices\GetAllUsersService;
use App\Services\UserServices\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UserController extends Controller
{
    public function __construct(protected IUserRepository $repository)
    {

    }


    public function index(UserService $service): Collection|LengthAwarePaginator
    {
        return $service->getAllUsers();
    }

    public function show(UserService $service, int $user_id): ?User
    {
        return $service->getUserById($user_id);
    }


    public function register(UserRequest $request): UserResource
    {
        $validated = $request->validated();
        $user = User::query()->create($validated);

        return new UserResource($user);
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
        dd($users);
        return UserResource::collection($users);

    }

}
