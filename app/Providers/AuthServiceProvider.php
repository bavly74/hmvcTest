<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Models\User;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */


    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('is_admin',function(User $user){
            return $user->hasRole('admin') ;
        });

        Gate::define('is_user',function(User $user){
            return $user->hasRole('user') ;
        });
        Gate::define('is_student',function(User $user){
            return $user->hasRole('student') ;
        });
    }
}
