<?php

namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param Request $request
     * @return string|null
     * @throws AuthenticationException
     */
    protected function redirectTo($request): ?string
    {
        // Since user is not authenticated the throw exception
        throw new AuthenticationException;
    }
}
