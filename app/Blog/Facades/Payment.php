<?php

namespace App\Blog\Facades;

use Illuminate\Support\Facades\Facade;

class Payment extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return session('payment_method');
    }
}
