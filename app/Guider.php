<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guider extends Model
{
    protected $fillable = [
        'name', 'phone','fees'
    ];
}
