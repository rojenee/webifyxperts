<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('customer', function ($user) {
            return in_array('customer', $this->getRoles($user));
        });

        Gate::define('staff', function ($user) {
            return in_array('staff', $this->getRoles($user));
        });
    }

    public function getRoles($user): array
    {
        $user_role = [];
        foreach ($user->roles as $role) {
            array_push($user_role, $role->role_name);
        }
        return $user_role;
    }
}
