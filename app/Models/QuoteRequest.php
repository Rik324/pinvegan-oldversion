<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'status',
        'user_id',
    ];

    /**
     * The fruits that belong to the quote request.
     *
     * This defines the many-to-many relationship with the Fruit model.
     * The explicit foreign key arguments have been removed to allow Laravel
     * to use its conventions, which now match the corrected database schema.
     * It will correctly look for 'quote_request_id' and 'fruit_id' in the
     * 'fruit_quote_request' pivot table.
     */
    public function fruits()
    {
        return $this->belongsToMany(Fruit::class, 'fruit_quote_request')->withPivot('quantity');
    }
    
    /**
     * Get the user that owns the quote request.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
