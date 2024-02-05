<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Property extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasSlug;

    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['name'])
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(50)
            ->usingSeparator('-')
            ;
    }

    protected $fillable = [
        'name',
        'category_id',
        'country_id',
        'warrenty',
        'short_description',
        'description',
        'keywords',
        'technical_specification',
        'promo',
        'featured',
        'discounted',
        'trending',
        'best_seller',
        'status',
        'state_id',
        'city_id',
        'user_id',
    ];


    public function propertyDetails()
    {
        return $this->hasMany(PropertyDetail::class)->orderBy('order_id', 'asc')->with('photo');
    }

    public function onSaleAttributes()
    {
        return $this->hasMany(PropertyDetail::class)
            ->with(['maxRate', 'photo'])
            ->where('status', 1)
            ->where('qty', '>', 0)
            ->orderBy('order_id', 'asc');
    }

    public function details()
    {
        return $this->hasMany(PropertyDetail::class)
            ->with(['reviews', 'photo', 'maxRate'])
            ->where('status', 1)
            ->where('qty', '>', 0)
            ->orderBy('order_id', 'asc');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function tax()
    {
        return $this->belongsTo(Tax::class)->withDefault(['value' => 0]);
    }
}
