<?php

namespace App\Providers;

use App\Contracts\ContactRequestContract;
use App\Models\ContactRequest;
use App\Observers\ContactRequestObserver;
use App\Services\ContactRequestService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        Paginator::useBootstrapFive();
        ContactRequest::observe(ContactRequestObserver::class);

        $this->app->bind(ContactRequestContract::class, ContactRequestService::class);
    }
}
