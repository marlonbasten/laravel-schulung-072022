<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\ContactRequest;
use App\Models\User;
use App\Policies\ContactRequestPolicy;
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
        ContactRequest::class => ContactRequestPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('delete-contact-request', function (User $user, ContactRequest $contactRequest) {
            return $user->isAdmin();
        });
    }
}
