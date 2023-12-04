<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripPlace extends Model
{ 
    protected $fillable = [
        'latitude',
        'longitude',
        'place_name',
        'trip_id',
        'city_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
