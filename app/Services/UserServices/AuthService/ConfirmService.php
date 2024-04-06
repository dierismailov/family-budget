<?php

namespace App\Services\UserServices\AuthService;

use App\Contracts\IUserRepository;
use App\Exceptions\CodeNoConfirmException;
use Illuminate\Support\Facades\Cache;

class ConfirmService
{
    public function __construct(
        private IUserRepository $repository
    )
    {

    }

    /**
     * @throws CodeNoConfirmException
     */
    public function execute(int $code)
    {
         $cache = Cache::get('data-for-register');
         $cacheCode = $cache['code'];
         $cacheEmail = $cache['email'];

         if ($code !== $cacheCode){
             throw new CodeNoConfirmException(__('message.not_confirmed'), 400);
         }

         $user = $this->repository->getUserByEmail($cacheEmail);
         $user->email_verified_at = now();
         $user->save();



    }
}
