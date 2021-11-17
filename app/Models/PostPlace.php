<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostPlace extends Model
{
    //
    protected $fillable = [
        'latitude',
        'longitude',
        'place_name',
        'post_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
   
}