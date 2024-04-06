<?php

namespace App\Services\UserServices\AuthService;

use App\Contracts\IUserRepository;
use App\Exceptions\ModelUserNotFoundException;
use App\Exceptions\NotVerifiedException;
use App\Exceptions\PasswordIncorrectException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function Symfony\Component\String\u;

class LoginService
{
    public function __construct(
        private IUserRepository $repository
    )
    {

    }

    /**
     * @throws ModelUserNotFoundException
     * @throws NotVerifiedException
     * @throws PasswordIncorrectException
     */
    public function execute(array $data): string
    {
        /** @var User $user */
        $user = $this->repository->getUserByEmail($data['email']);

        if ($user === null) {
            throw new ModelUserNotFoundException(__('message.user_not_found'),403);
        }

        if ($user->email_verified_at === null){
            throw new NotVerifiedException(__('message.email_not_verified'),403);
        }
        if (!Hash::check($data['password'] , $user->password)){
            throw new PasswordIncorrectException(__('message.password_mismatch'),400);
        }

        return $user->createToken('access_token',
            ['server:update'],
            now()->addDays(1) )->plainTextToken;

    }
}
