<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'image', 'caption', 'order'
    ];

    public static function boot()
    {
        parent::boot();

        static::deleting(function($slider) {
            removeFile($slider->image);
        });
    }
}
