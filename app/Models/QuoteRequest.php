<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteRequest extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'status'
    ];

    /**
     * The fruits included in this quote request.
     */
    public function fruits()
    {
        return $this->belongsToMany(Fruit::class, 'fruit_quote_request')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}
