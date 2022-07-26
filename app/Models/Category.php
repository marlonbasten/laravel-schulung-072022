<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function contactRequests()
    {
        return $this->hasMany(ContactRequest::class);
    }
}
