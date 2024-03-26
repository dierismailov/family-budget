<?php

namespace App\Http\Controllers;

use App\Contracts\IBudgetRepository;
use App\DTO\BudgetDTO;
use App\Exceptions\BusinessException;
use App\Http\Requests\BudgetRequest;
use App\Http\Requests\LimitRequest;
use App\Http\Resources\BudgetResource;
use App\Models\Budget;
use App\Models\User;
use App\Services\BudgetServices\BudgetService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;

class BudgetController extends Controller
{
    public function __construct(
        private IBudgetRepository $repository
    )
    {

    }



    public function store( BudgetService $service, BudgetRequest $request, int $user_id): mixed
    {
        $validated = $request->validated();
        return $service->addBudget(BudgetDTO::fromArray($validated), $user_id);

    }

    /**
     * Получить все бюджеты для указанного пользователя.
     *
     * @param BudgetService $service
     * @param int $user_id
     * @return BusinessException|BudgetResource|Collection|AnonymousResourceCollection
     */
    public function budgetsListUser(
        BudgetService $service, int $user_id
    ): BusinessException|BudgetResource|Collection|AnonymousResourceCollection
    {

        return $service->getAllBudgetByUserId($user_id);
    }

    public function setLimitExpense(BudgetService $service, LimitRequest $request,  int $budget_id): bool
    {
        $validated = $request->validated();
        return $service->setLimit($validated, $budget_id);
    }


}
