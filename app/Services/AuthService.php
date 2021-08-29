<?php

namespace App\Services;

use App\Models\Token;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class AuthService
{
    /**
     * Authenticate the user with the given credentials
     *
     * @param string $email
     * @param string $password
     * @return User
     * @throws AuthenticationException
     */
    public function authenticate(string $email, string $password): User
    {
        $fail = false;
        if (!$user = User::where('email', $email)->first()) {
            $fail = true;
        } elseif ($user->password !== $password) {
            $fail = true;
        }

        if ($fail) {
            throw new AuthenticationException('User could not be authenticated');
        }

        return $user;
    }

    /**
     * Generate a new api token and add it to the database
     *
     * @param User $user
     * @return Token
     */
    public function createApiToken(User $user): Token
    {
        // Remove any old api tokens
        // For now we don't want multiple logins
        $this->removeTokens($user->id, 'api');

        return Token::create([
            'userId' => $user->id,
            'type' => 'api',
            // Just generate a simple random hashed string
            // If this was a more robust auth system real web tokens
            // or something similar would probably be used.
            'token' => hash('sha512', Str::random(32)),
            // The token will expire in one hour
            'expiresAt' => (new Carbon())->addHour(),
        ]);
    }

    /**
     * Exchange the given token for a new one
     *
     * @param string $uid
     * @param string $token
     * @return Token
     * @throws AuthenticationException
     */
    public function refreshApiToken(string $uid, string $token): Token
    {
        // Get the user by uid
        $user = User::where('uid', $uid)->first();

        if (!$user || !$user->apiToken) {
            throw new AuthenticationException('Invalid api token');
        }

        return $this->createApiToken($user);
    }

    /**
     * Remove all of the user's tokens with the given type
     *
     * @param string $uid
     * @param string $type
     * @return void
     */
    public function removeTokens(string $uid, string $type): void
    {
        // Remove any old tokens of the given type
        // For now we don't want multiple logins
        Token::where('user_id', $uid)->where('type', $type)->delete();
    }

    /**
     * Register a new user
     *
     * @param string $name
     * @param string $email
     * @param string $password
     * @return User
     */
    public function register(string $name, string $email, string $password): User
    {
        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);
    }

    /**
     * Verify the given token and return the user object
     *
     * @param string $token
     * @param string $prefix
     * @return User
     * @throws AuthenticationException
     */
    public function verifyApiToken(string $token, string $prefix): User
    {
        $token = trim(Str::after($token, $prefix));

        if (!$token = Token::where('token', $token)->first()) {
            throw new AuthenticationException();
        }

        if (!$user = User::where('id', $token->userId)->first()) {
            throw new AuthenticationException();
        }

        return $user;
    }
}
