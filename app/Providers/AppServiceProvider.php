<?php

namespace App\Providers;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
        Gate::define('admin',function(User $user){
            return $user->role == Role::ADMIN;
        });
        Gate::define('supervisor',function(User $user){
            return $user->role == Role::SUPERVISOR;
        });
        Gate::define('user',function(User $user){
            return $user->role == Role::USER;
        });
        Gate::define('staff',function(User $user){
            return $user->role == Role::STAFF;
        });
        Gate::define('service',function(User $user){
            return $user->role == Role::SERVICE;
        });
        $this->register();
    }
}
