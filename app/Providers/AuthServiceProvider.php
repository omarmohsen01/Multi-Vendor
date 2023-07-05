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
        'App\Models\Product'=>'App\Policies\ProductPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::before(function ($user,$ability){
            if($user->super_admin){
                return true;
            }
        });
        
        foreach(config('abilities') as $code=>$label){
            Gate::define($code,function($user) use ($code){
                return $user->hasAbility($code);
            });
        }

        
    }
}