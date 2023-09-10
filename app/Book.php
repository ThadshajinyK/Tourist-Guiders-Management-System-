<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'customer', 'booked_date', 'payment','fees','guider','place','days'
    ];
}
