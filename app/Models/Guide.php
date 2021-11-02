<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guide extends Model
{
    use SoftDeletes;

    public const CAR_RADIO = [
        '1' => 'yes',
        '0' => 'no',
    ];

    public const DRIVING_LICENCE_RADIO = [
        '1' => 'yes',
        '0' => 'no',
    ];

    public const DEGREE_RADIO = [
        'graduate' => 'graduate',
        'student'  => 'student',
    ];

    public $table = 'guides';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'brief_intro',
        'driving_licence',
        'car',
        'degree',
        'major',
        'user_id',
        'cost',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
