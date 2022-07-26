<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactRequest extends Model
{
    use SoftDeletes;

    // Falls der Tabellenname nicht "contact_requests" ist, muss dieser hier angegeben werden.
//    protected $table = 'kontaktanfragen';

//    protected $fillable = [
//        'name',
//        'email',
//        'message',
//    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst($value)
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
