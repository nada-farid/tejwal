<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LanguagePost extends Model
{
    
    public $table = 'language_post';

    protected $fillable = [
        'post_id',
        'language_id', 
        'created_at',
        'updated_at', 
    ];

    public function language(){
        return $this->belongsTo(Language::class);
    }
}
