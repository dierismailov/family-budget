<?php

namespace App\Services\BudgetServices;

use App\Contracts\IBudgetRepository;
use App\Contracts\IUserRepository;
use App\Exceptions\ModelUserNotFoundException;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;

class GetBudgetsForUserService
{
    public function __construct(
        private IBudgetRepository $repository,
        private IUserRepository $userRepository
    )
    {

    }

    /**
     * @throws ModelUserNotFoundException
     */
    public function execute(int $user_id): Paginator
    {
        $user = $this->userRepository->getUserById($user_id);

        if ($user === null) {
            throw new ModelUserNotFoundException(__('message.user_not_found'), 403);
        }

        return $this->repository->getAllBudgetByUserId($user_id);
    }
}
