<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

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
        Passport::hashClientSecrets();
        //Hashage du secret client
        Passport::tokensExpireIn(now()->addDays(15));
        //Duree de vie des jetons

        $this->registerPolicies();
        
        //This will fetch the required routes for your code.
    }
}
