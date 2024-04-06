<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\IUserRepository;
use App\Exceptions\ModelUserNotFoundException;
use App\Exceptions\NotVerifiedException;
use App\Exceptions\PasswordIncorrectException;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequests\LoginRequest;
use App\Services\UserServices\AuthService\LoginService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(
        protected IUserRepository $repository
    )
    {

    }

    /**
     * @throws NotVerifiedException
     * @throws PasswordIncorrectException
     * @throws ModelUserNotFoundException
     */
    public function login(LoginRequest $request, LoginService $service): JsonResponse
    {
        $validated = $request->validated();
        $token = $service->execute($validated);

        return response()->json([
            'token' => $token
        ]);

    }


    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
