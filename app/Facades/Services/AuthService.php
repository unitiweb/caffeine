<?php

namespace App\Facades\Services;

use App\Models\User;
use App\Models\Token;
use Illuminate\Support\Facades\Facade;

/**
 * AuthService facade
 *
 * @package App\Facades\Services
 *
 * @method static User authenticate(string $email, string $password)
 * @method static User register(string $name, string $email, string $password)
 * @method static Token createApiToken(User $user)
 * @method static User verifyApiToken(string $token, string $prefix)
 * @method static Token refreshApiToken(string $uid, string $token)
 */
class AuthService extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return \App\Services\AuthService::class;
    }
}
