<?php

namespace App\Services\UserServices;

use App\Contracts\IBudgetRepository;
use App\Contracts\IBudgetUserRepository;
use App\Contracts\IUserRepository;
use App\Exceptions\BusinessException;
use App\Exceptions\ModelBudgetNotFoundException;
use App\Exceptions\ModelUserNotFoundException;
use App\Http\Requests\UserRequests\InputUserRequest;
use App\Models\Budget;
use App\Models\BudgetUser;
use App\Models\User;

class CheckUserForAddService
{
    public function __construct(
        private IUserRepository $repository,
        private IBudgetRepository $budgetRepository,
        private IBudgetUserRepository $budgetUserRepository
    )
    {

    }

    /**
     * @throws ModelUserNotFoundException
     * @throws ModelBudgetNotFoundException
     * @throws BusinessException
     */
    public function execute(int $budget_id, InputUserRequest $request): string
    {

        $user_id = $request->input('user');
        $userExists = $this->repository->getUserById($user_id);

        if ($userExists === null) {
            throw new ModelUserNotFoundException(__('message.user_not_found'), 403);
        }
        /** @var Budget|null $budget */
        $budget = $this->budgetRepository->getBudgetById($budget_id);

        if ($budget === null) {
            throw new ModelBudgetNotFoundException(__('message.budget_not_found'), 403);
        }

        $userAdded =  $this->budgetUserRepository->checkExistByUserIdAndBudgetId($user_id, $budget_id);

        if (count($userAdded) !== 0 ){
            throw new BusinessException(__('message.user_was_added'), 409);
        }


         $this->repository->sendEmailForUser($userExists, $budget_id);

        return 'The message has been sent';

    }
}
