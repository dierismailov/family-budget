<?php

namespace App\Http\Controllers;

use App\Contracts\IUserRepository;
use App\Exceptions\BusinessException;
use App\Http\Requests\AuthRequests\PersonalAccessTokenRequest;
use App\Services\UserServices\CreateUserTokenService;
use Illuminate\Http\JsonResponse;

class PersonalAccessTokenController extends Controller
{
    public function __construct(protected IUserRepository $repository)
    {

    }

    /**
     * @throws BusinessException
     */
    public function store(PersonalAccessTokenRequest $request, CreateUserTokenService $service): JsonResponse
    {
        $request->validated();
        $token = $service->execute($request);
        return response()->json($token);
    }
}
