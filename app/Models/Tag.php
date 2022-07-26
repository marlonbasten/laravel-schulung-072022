<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function contactRequests()
    {
        return $this->belongsToMany(ContactRequest::class);
    }
}
