<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    public $table = 'posts';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'price',
        'tourist_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function Tourist()
    {
        return $this->belongsTo(Tourist::class, 'tourist_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    public function places(){

        return $this->hasMany(PostPlace::class);
    }
    public function language()
    {
        return $this->belongsTo(Language::class, 'lang_id');
    }
}
