<?php

namespace App\Providers;

use App\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('userEmailConfirmed', function ($user) {
            if($user->confirmedEmail()) {
                return true;
            }

            return false;
        });

        Gate::define('admin', function($user) {
            $role = Role::where('name', 'Администратор')->get()->first()->id;
            return $user->roles->contains($role);
        });

    }
}
