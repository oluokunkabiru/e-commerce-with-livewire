<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Property::class);
    }

    public function attribute()
    {
        return $this->belongsTo(PropertyDetail::class, 'product_attr_id')->with('photo');
    }
}
