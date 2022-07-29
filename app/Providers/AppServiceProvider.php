<?php

namespace App\Providers;

use App\Blog\Blog;
use App\Blog\Klarna;
use App\Blog\PayPal;
use App\Blog\Test;
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
        $this->app->bind('blog', function () {
            return new Blog();
        });
        $this->app->bind('test', function () {
            return new Test();
        });
        $this->app->bind('paypal-checkout', function () {
            return new PayPal();
        });
        $this->app->bind('klarna-checkout', function () {
            return new Klarna();
        });
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
