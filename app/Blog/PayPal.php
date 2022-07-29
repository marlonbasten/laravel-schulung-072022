<?php

namespace App\Blog;

use Illuminate\Support\Facades\Log;

class PayPal
{
    public function checkout(): string
    {
        return 'https://paypal.com/checkout/...';
    }

    public function callback(array $data): bool
    {
        Log::info('Es wurde erfolgreich über PayPal bezahlt.');
    }
}
