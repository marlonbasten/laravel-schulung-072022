<?php

namespace App\Blog\Facades;

use Illuminate\Support\Facades\Facade;

class Blog extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return auth()->user()->formal() ? 'blog' : 'test';
    }
}
