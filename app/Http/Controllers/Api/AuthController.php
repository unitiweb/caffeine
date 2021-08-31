<?php

namespace App\Http\Controllers\Api;

use App\Facades\Services\AuthService;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\TokenResource;
use App\Http\Resources\UserResource;

/**
 * Controller class to handle authentication related requests
 * @package App\Http\Controllers\Api
 */
class AuthController extends ApiController
{
    /**
     * Authenticate the given user credentials
     *
     * @param LoginRequest $request
     * @return UserResource
     */
    public function login(LoginRequest $request): UserResource
    {
        $data = $request->validated();

        // Authenticate the user's credentials
        // If authentication fails then an exception will be thrown
        $user = AuthService::authenticate($data['email'], $data['password']);
        $token = AuthService::createApiToken($user);

        return (new UserResource($user))->additional([
            'token' => new TokenResource($token),
        ]);
    }

    /**
     * Register a new user
     *
     * @param RegisterRequest $request
     * @return UserResource
     */
    public function register(RegisterRequest $request): UserResource
    {
        $data = $request->validated();
        $user = AuthService::register($data['name'], $data['email'], $data['password']);

        return new UserResource($user);
    }
}
