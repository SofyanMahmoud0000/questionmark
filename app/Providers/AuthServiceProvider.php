<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    
    public function boot()
    {
        $this->registerPolicies();

        Gate::define("Settings" , "App\Policies\Policies@Settings");

        Gate::define("Follow" , "App\Policies\Policies@Follow");

        Gate::define("Me" , "App\Policies\Policies@Me");

        Gate::define("Team" , "App\Policies\Policies@Team");

        Gate::define("MyQuestion" , "App\Policies\Policies@MyQuestion");
    }
}
