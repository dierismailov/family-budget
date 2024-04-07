<?php

namespace App\Services\BudgetServices;

use App\Contracts\IBudgetRepository;
use App\Contracts\IUserRepository;
use App\Exceptions\ModelUserNotFoundException;
use App\Models\User;

class DeleteBudgetService
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
    public function execute(int $user_id, int $budget_id): bool
    {
        $user = $this->userRepository->getUserById($user_id);

        if ($user === null) {
            throw new ModelUserNotFoundException(__('message.user_not_found'), 403);
        }

        return $this->repository->deleteBudget($budget_id);
    }

}
