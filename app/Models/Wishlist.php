<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function attribute()
    {
        return $this->belongsTo(PropertyDetail::class, 'property_attr_id')->with('photo');
    }
}
