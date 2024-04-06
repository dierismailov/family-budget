<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\IUserRepository;
use App\DTO\UserDTO;
use App\Exceptions\BusinessException;
use App\Exceptions\CodeNoConfirmException;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequests\ConfirmRequest;
use App\Http\Requests\UserRequests\StoreUserRequest;
use App\Services\UserServices\AuthService\ConfirmService;
use App\Services\UserServices\AuthService\RegisterService;

class RegisterController extends Controller
{

    public function __construct(
        protected IUserRepository $repository
    )
    {

    }

    /**
     * @throws BusinessException
     */
    public function register(StoreUserRequest $request, RegisterService $service): BusinessException
    {
        $validated = $request->validated();
        $service->execute(UserDTO::fromArray($validated));

        throw new BusinessException(__('message.code_sent'), 200);

    }

    /**
     * @throws BusinessException
     * @throws CodeNoConfirmException
     */
    public function confirm(ConfirmRequest $request, ConfirmService $service)
    {
        $request->validated();
         $service->execute($request->input('code'));

        throw new BusinessException(__('message.code_confirmed'), 200);

    }
}
