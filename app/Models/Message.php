<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface; 
use Illuminate\Database\Eloquent\SoftDeletes; 


class Message extends Model
{
    use SoftDeletes;

    public $table = 'messages';


    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'message',
        'seen',
        'user_id', 
        'conversation_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function conversation(){
        return $this->belongsTo(Conversation::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
