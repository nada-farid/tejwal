<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripTripCategory extends Model
{
    
    public $table = 'trip_trip_category';

    protected $dates = [
        'created_at',
        'updated_at', 
    ];

    protected $fillable = [
        'trip_id',
        'trip_category_id', 
        'created_at',
        'updated_at', 
    ];

    public function category()
    {
        return $this->belongsTo(TripCategory::class, 'trip_category_id');
    }
}
