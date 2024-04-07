<?php

namespace App\Services\UserServices;

use App\Contracts\IBudgetRepository;
use App\Contracts\IUserRepository;
use App\Exceptions\BusinessException;
use App\Exceptions\ModelBudgetNotFoundException;
use App\Exceptions\ModelUserNotFoundException;
use App\Http\Requests\UserRequests\ConfirmEmailRequest;
use App\Models\Budget;
use App\Models\User;

class AddUserInBudgetService
{
    public function __construct(
        private IUserRepository $repository,
        private IBudgetRepository $budgetRepository
    )
    {

    }

    /**
     * @throws ModelUserNotFoundException
     * @throws ModelBudgetNotFoundException
     * @throws BusinessException
     */
    public function execute(ConfirmEmailRequest $request): BusinessException
    {

        $budget_id = $request->input('budget');
        $budget = $this->budgetRepository->getBudgetById($budget_id);

        $token = $request->input('token');
        $user = $this->repository->getUserByToken($token);

        if ($user === null) {
            throw new ModelUserNotFoundException(__('message.user_not_found'), 403);
        }

        if ($budget === null) {
            throw new ModelBudgetNotFoundException(__('message.budget_not_found'), 403);
        }

         $this->repository->addUserInBudget($budget_id, $user->id);

        throw new BusinessException(__('message.user_added_successfully'), 200);

    }


}
