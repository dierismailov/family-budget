<?php

namespace App\Http\Controllers;

use App\Contracts\ITransactionRepository;
use App\DTO\TransactionDTO;
use App\Http\Requests\TransactionRequests\TransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use App\Services\TransactionServices\getTransactionByBudgetService;
use App\Services\TransactionServices\StoreTransactionService;
use App\Services\TransactionServices\GetTransactionByUserService;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;

class TransactionController extends Controller
{
    public function __construct(
        protected ITransactionRepository $repository
    )
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionRequest $request, StoreTransactionService $service): TransactionResource
    {
         $validated = $request->validated();
         $transaction = $service->execute(TransactionDTO::fromArray($validated));

         return new TransactionResource($transaction);
    }

    public function getTransactionsByBudget(
        int $budget_id,
        getTransactionByBudgetService $service
    ): AnonymousResourceCollection|Collection
    {
        return $service->execute($budget_id);
    }
    public function getTransactionsByUser(
        int $user_id,
        GetTransactionByUserService $service
    ): AnonymousResourceCollection|Collection
    {
        return $service->execute($user_id);
    }
}
