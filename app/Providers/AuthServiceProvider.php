<?php

namespace App\Providers;

use App\Facades\Services\AuthService;
use App\Models\Consumed;
use App\Models\Drink;
use App\Models\User;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     * @throws AuthenticationException
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('drink', function (User $user, Drink $drink) {
            return $user->id === $drink->user_id;
        });

        Gate::define('consumed', function (User $user, Consumed $consumed) {
            return $user->id === $consumed->user_id;
        });

        // Define the api token guards driver
        // The driver is set in the config/auth.php file
        Auth::viaRequest('api-token', function (Request $request) {
            // If the authorization header exists then try to validate the jwt token
            if ($request->hasHeader('Authorization')) {
                $token = $request->header('Authorization');
                try {
                    return AuthService::verifyApiToken($token, 'Bearer ');
                } catch (Exception $ex) {
                    throw new AuthenticationException($ex->getMessage());
                }
            }

            return null;
        });
    }
}
