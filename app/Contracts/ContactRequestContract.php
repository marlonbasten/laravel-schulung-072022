<?php

namespace App\Contracts;

use App\Models\ContactRequest;

interface ContactRequestContract
{
    public function create(array $data): ContactRequest;
}
