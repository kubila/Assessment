<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\ProductPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Product::class => ProductPolicy::class,
        //Category::class => CategoryPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-categories', function (User $user) {
            // 2 is admin
            return $user->role_id == 2;
        });

        Gate::define('view-categories', function (User $user) {
            // 1 is member, 2 is admin
            return $user->role_id == 1 || $user->role_id == 2;
        });

        Gate::define('manage-products', function (User $user) {
            // 2 is admin
            return $user->role_id == 2;
        });

        Gate::define('view-products', function (User $user) {
            // 1 is member, 2 is admin
            return $user->role_id == 1 || $user->role_id == 2;
        });

        Gate::define('manage-cart', function (User $user) {
            // 1 is member
            return $user->role_id == 1;
        });

    }
}
