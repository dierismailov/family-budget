<?php

namespace App\Services\UserServices;

use App\Contracts\IUserRepository;
use App\Exceptions\BusinessException;
use App\Http\Requests\PersonalAccessTokenRequest;

class CreateUserTokenService
{
    public function __construct(
        private IUserRepository $repository
    )
    {

    }

    /**
     * @throws BusinessException
     */
    public function execute(PersonalAccessTokenRequest $request): string
    {
        $userWithEmail = $this->repository->getUserByEmail($request->email);
        if ($userWithEmail === null) {
            throw new BusinessException(__('message.user_not_found'), 403);
        }

        return $this->repository->createUserToken($request->email, $userWithEmail);

    }
}
