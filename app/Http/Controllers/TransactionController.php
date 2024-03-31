<?php

namespace App\Http\Controllers;

use App\Contracts\ITransactionRepository;
use App\Http\Requests\TransactionRequests\TransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use App\Services\TransactionServices\TransactionService;
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
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $transactions = Transaction::all();

        return response()->json($transactions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionRequest $request): TransactionResource
    {
         $validated = $request->validated();

         $transaction = Transaction::query()->create($validated);

         return new TransactionResource($transaction);
    }

    public function getTransactionsByBudget(
        int $budget_id,
        TransactionService $service
    ): AnonymousResourceCollection|Collection
    {
        return $service->getTransactionByBudget($budget_id);
    }
    public function getTransactionsByUser(
        int $user_id,
        TransactionService $service
    ): AnonymousResourceCollection|Collection
    {
        return $service->getTransactionByUser($user_id);
    }
}
