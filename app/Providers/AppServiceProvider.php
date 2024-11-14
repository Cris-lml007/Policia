<?php

namespace App\Providers;

use App\Enums\Role;
use App\Models\User;
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
        Gate::define('admin',function(User $user){
            return $user->role == Role::ADMIN;
        });
        Gate::define('supervisor',function(User $user){
            return $user->role == Role::SUPERVISOR;
        });
        Gate::define('user',function(User $user){
            return $user->role == Role::USER;
        });
    }
}
