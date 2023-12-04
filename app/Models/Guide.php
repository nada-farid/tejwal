<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Nagy\LaravelRating\Traits\Rate\Rateable;


class Guide extends Model
{
    use SoftDeletes;
    use HasApiTokens;
    use Rateable;


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

    public const LEVELS_RADIO = [
        'beginner' => 'Beginner',
        'intermediate'  => 'intermediate',
        'advanced'=>'Advanced',
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
        'organization_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    public function experience(){

        return $this->hasMany(Experience::class);
    
    }
    
    public function follower(){

        return $this->hasMany(following::class);
    }

    
    public function trip(){

        return $this->hasMany(Trip::class);
    }
}
