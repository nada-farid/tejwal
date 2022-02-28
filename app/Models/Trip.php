<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Trip extends Model implements HasMedia
{
    use SoftDeletes;
    use HasMediaTrait;

    public $table = 'trips';

    public const CAR_RADIO = [
        '1' => 'yes',
        '0' => 'no',
    ];

    public const CURRENCY_TYPE_SELECT = [
        'USD' => 'USD',
        'SAR' => 'SAR',
        'EGP' => 'EGP',
    ];

    protected $appends = [
        'photo',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'description',
        'price',
        'currency_type',
        'guide_id',
        'car',
        'trip_name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getPhotoAttribute()
    {
        $files = $this->getMedia('photo');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
        });

        return $files;
    }

    public function guide()
    {
        return $this->belongsTo(Guide::class, 'guide_id');
    }

    public function trip_categories()
    {
        return $this->belongsToMany(TripCategory::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    public function places()
    {
        return $this->hasMany(TripPlace::class);
    }
    public function tripFavorites()
    {
        return $this->hasMany(Favorite::class);
    }
    
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
