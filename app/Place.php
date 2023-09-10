<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
        'place', 'district', 'location','address','description','image','guider'
    ];
}
