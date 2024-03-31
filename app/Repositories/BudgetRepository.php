<?php

namespace App\Repositories;

use App\Contracts\IBudgetRepository;
use App\DTO\BudgetDTO;
use App\Exceptions\BusinessException;
use App\Jobs\CreateRecordInBudgetMemberTable;
use App\Models\Budget;
use App\Models\BudgetUser;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;

class BudgetRepository implements IBudgetRepository
{
    public function getAll(): Paginator
    {
        return Budget::query()->simplePaginate(15);
    }


    /**
     * Получить все бюджеты для указанного пользователя.
     *
     * @param int $user_id
     */
        public function getAllBudgetByUserId(int $user_id): Paginator
    {

        return Budget::query()->where('creator_id', $user_id)->simplePaginate(10);
    }

    /**
     * @throws BusinessException
     */
    public function getBudgetById(int $user_id, int $budget_id): ?Budget
    {
        /**  @var Budget|null $budget */
        $budget = Budget::query()->find($budget_id);
        $user = BudgetUser::query()->where('user_id', $user_id)->where('budget_id', $budget_id)->first();

        if ($user === null){
            throw new BusinessException(__('message.you_not_included'), 403);
        }else {
            return $budget;
        }


    }

    /**
     * @throws BusinessException
     */
    public function storeBudgetByUser(BudgetDTO $budgetDTO, int $user_id): Budget
    {

    {
        $nameExist = Budget::query()->where('name', $budgetDTO->getName())->where('creator_id', $user_id)->first();

        if ($nameExist !== null){
            throw new BusinessException(__('message.budget_exist'), 403);
        }


        $budget = new Budget();
        $budget->name = $budgetDTO->getName();
        $budget->creator_id = $user_id;
        $budget->status = $budgetDTO->getStatus();
        $budget->limit = $budgetDTO->getLimit();
        $budget->save();

        CreateRecordInBudgetMemberTable::dispatch($user_id, $budget);

        return  $budget;
    }
    }

    public function setLimit(int $limit, int $budget_id): bool
    {
        $budget = Budget::query()->find($budget_id);
        if (!$budget) {
            // Обработка ситуации, когда бюджет не найден
            return false;
        }

        $budget->limit = $limit;
        try {
            $budget->save();
            return true;
        } catch (\Exception $e) {
            // Обработка ошибки при сохранении изменений
            return false;
        }
    }

    public function updateBudget(BudgetDTO $budgetDTO,Budget $budget, int $user_id): ?Budget
    {
        $budget->name = $budgetDTO->getName();
        $budget->creator_id = $user_id;
        $budget->status = $budgetDTO->getStatus();
        $budget->limit = $budgetDTO->getLimit();
        $budget->save();

        return  $budget;
    }

    public function deleteBudget(int $budget_id): bool
    {
         $budget = Budget::query()->find($budget_id);

         if($budget === null) {
            return false;
         }else {
             $budget->delete();
             return true;
         }
    }
}
