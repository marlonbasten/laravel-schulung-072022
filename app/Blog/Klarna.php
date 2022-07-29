<?php

namespace App\Blog;

use Illuminate\Support\Facades\Log;

class Klarna
{
    public function checkout(): string
    {
        return 'https://klarna.com/checkout/...';
    }

    public function callback(array $data): bool
    {
        Log::info('Es wurde erfolgreich über Klarna bezahlt.');
    }
}
