<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserServices\RegisterService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(StoreUserRequest $request, RegisterService $service): UserResource
    {
        $validated = $request->validated();
        $user = $service->execute($validated);

        return new UserResource($user);
    }
}
