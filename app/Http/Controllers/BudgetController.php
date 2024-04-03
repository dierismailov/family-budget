<?php

namespace App\Http\Controllers;

use App\Contracts\IBudgetRepository;
use App\DTO\BudgetDTO;
use App\Exceptions\BusinessException;
use App\Exceptions\ModelBudgetNotFoundException;
use App\Exceptions\ModelUserNotFoundException;
use App\Http\Requests\BudgetRequests\LimitRequest;
use App\Http\Requests\BudgetRequests\StoreBudgetRequest;
use App\Http\Resources\BudgetResource;
use App\Services\BudgetServices\BudgetService;
use App\Services\BudgetServices\CreateBudgetService;
use App\Services\BudgetServices\DeleteBudgetService;
use App\Services\BudgetServices\GetAllBudgetsService;
use App\Services\BudgetServices\GetBudgetByIdService;
use App\Services\BudgetServices\GetBudgetsForUserService;
use App\Services\BudgetServices\SetLimitForBudgetService;
use App\Services\BudgetServices\UpdateBudgetService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;

class BudgetController extends Controller
{
    public function __construct(
        private IBudgetRepository $repository
    )
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @param  GetAllBudgetsService  $service
     * @return AnonymousResourceCollection
     */
    public function index(GetAllBudgetsService $service): AnonymousResourceCollection
    {
        $budgets = $service->execute();

        return  BudgetResource::collection($budgets);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateBudgetService $service
     * @param StoreBudgetRequest $request
     * @param int $user_id
     * @return BudgetResource
     */
    public function store(CreateBudgetService $service, StoreBudgetRequest $request, int $user_id): BudgetResource
    {
        $validated = $request->validated();
        $budget =  $service->execute(BudgetDTO::fromArray($validated), $user_id);

         return new BudgetResource($budget);
    }

    /**
     * Display the specified resource.
     *
     * @param GetBudgetByIdService $service
     * @param int $user_id
     * @param int $budget_id
     * @return BudgetResource
     * @throws ModelBudgetNotFoundException
     * @throws ModelUserNotFoundException
     */
    public function show(GetBudgetByIdService $service,int $user_id, int $budget_id): BudgetResource
    {
        $budget = $service->execute($user_id, $budget_id);

        return new BudgetResource($budget);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBudgetService $service
     * @param int $user_id
     * @param int $budget_id
     * @param StoreBudgetRequest $request
     * @return BudgetResource
     * @throws ModelBudgetNotFoundException
     */
    public function update(UpdateBudgetService $service, int $user_id, int $budget_id, StoreBudgetRequest $request): BudgetResource
    {
        $validated = $request->validated();
        $budget = $service->execute(BudgetDTO::fromArray($validated), $budget_id , $user_id);
        return new BudgetResource($budget);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteBudgetService $service
     * @param int $user_id
     * @param int $budget_id
     * @return BusinessException
     * @throws BusinessException
     * @throws ModelUserNotFoundException
     */
    public function destroy(DeleteBudgetService $service ,int $user_id, int $budget_id):BusinessException
    {
             $service->execute($user_id, $budget_id);
             throw new BusinessException(__('message.budget_deleted'), 400);
    }

    /**
     * Получить все бюджеты для указанного пользователя.
     *
     * @param GetBudgetsForUserService $service
     * @param int $user_id
     * @return AnonymousResourceCollection
     * @throws ModelUserNotFoundException
     */
    public function budgetsListUser(
        GetBudgetsForUserService $service, int $user_id
    ): AnonymousResourceCollection
    {
        $budgets = $service->execute($user_id);

        return BudgetResource::collection($budgets);
    }

    /**
     * @throws BusinessException
     */
    public function setLimitExpense(int $budget_id, SetLimitForBudgetService $service ): BusinessException
    {
            dd($budget_id);
            $validated = $request->validated();
            $result =  $service->execute($validated, $budget_id);

            if ($result){
                throw new BusinessException(__('message.limit_set'), 200);
            } else {

                throw new BusinessException(__('message.limit_not_set'), 400);
            }

    }


}
