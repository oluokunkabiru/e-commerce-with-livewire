<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function productDetails()
    {
        return $this->belongsTo(PropertyDetail::class, 'property_attr_id', 'id')->with('photo');
    }

    public function review()
    {
        return $this->hasOne(Review::class, 'property_attr_id', 'property_attr_id')
            ->where('user_id', auth()->id());
    }
}
