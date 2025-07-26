<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fruit extends Model
{
    protected $fillable = [
        'name',
        'description',
        'origin',
        'taste_profile',
        'seasonality',
        'is_available',
        'is_featured',
        'category_id',
        'image',
        'price'
    ];

    /**
     * The quote requests that include this fruit.
     */
    public function quoteRequests()
    {
        return $this->belongsToMany(QuoteRequest::class, 'fruit_quote_request')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
    
    /**
     * Get the category that this fruit belongs to.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
