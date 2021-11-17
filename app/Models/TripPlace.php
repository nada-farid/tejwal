<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripPlace extends Model
{
    //
    protected $fillable = [
        'latitude',
        'longitude',
        'place_name',
        'trip_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
   
}
