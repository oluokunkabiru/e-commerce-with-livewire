<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Slider extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;

    protected $guarded = [];
    protected $date    = ['deleted_at'];

    public function photo()
    {
        return $this->hasOne(Media::class, 'model_id')
            ->where('model_type', Slider::class)
            ->withDefault(['url' => null]);
    }
}
