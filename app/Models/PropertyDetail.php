<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PropertyDetail extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;

    protected $dates   = ['deleted_at'];
    protected $guarded = [];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }

    public function maxRate()
    {
        return $this->hasMany(Review::class, 'property_attr_id')
            ->addSelect('property_attr_id', 'property_attr_id', DB::raw("MAX(reviews.rate) AS max_rate"))
            ->groupBy('property_attr_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'property_attr_id')->with('user');
    }

    // public function photo()
    // {
    //     return $this->hasOne(Media::class, 'model_id')
    //         ->where('model_type', ProductDetail::class)
    //         ->withDefault(['url' => null]);
    // }

    public function photo(): HasOne
        {
            return $this->hasOne(Media::class, 'model_id')
                ->where('model_type', PropertyDetail::class);
        }




        public function getPriceAttribute($value)
        {
            // Manipulate the 'id' value here
            // For example, add a prefix or any transformation you want
            // return 'ID-' . $value;
            // info(Currency());
            return ($value * session()->get('rate') );
        }


}
