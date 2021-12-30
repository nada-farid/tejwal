<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface; 
use Illuminate\Database\Eloquent\SoftDeletes; 

class Conversation extends Model
{
    use SoftDeletes;

    public $table = 'conversations';


    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'sender_id',
        'receiver_id',  
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function sender(){
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver(){
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
