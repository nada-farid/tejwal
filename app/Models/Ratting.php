<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ratting extends Model
{
    use SoftDeletes;

    public $table = 'rattings';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'rate',
        'guide_id',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function guide()
    {
        return $this->belongsTo(Guide::class, 'guide_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
