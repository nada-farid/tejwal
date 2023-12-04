<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model; 

class SpeakingLanguage extends Model
{ 

    public $table = 'language_user';

    public const LEVLE_SELECT = [
        'beginner' => 'beginner',
        'intermediate' => 'intermediate',
        'advanced' => 'advanced',
    ];

    protected $dates = [
        'created_at',
        'updated_at', 
    ];

    protected $fillable = [
        'user_id',
        'language_id',
        'level',
        'created_at',
        'updated_at', 
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function language(){
        return $this->belongsTo(Language::class,'language_id');
    }
}
