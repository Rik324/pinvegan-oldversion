<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FruitTranslation extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'name',
        'description',
        'origin',
        'seasonality'
    ];
}