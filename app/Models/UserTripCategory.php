<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTripCategory extends Model
{
    
    public $table = 'user_trip_categories';

    protected $fillable = [
        'user_id',
        'trip_category_id', 
        'created_at',
        'updated_at', 
    ];

    public function category(){
        return $this->belongsTo(TripCategory::class,'trip_category_id');
    }
}
