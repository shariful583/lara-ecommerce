<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class product extends Model implements HasMedia
{
    use HasMediaTrait;
    protected $guarded = [];


    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::creating(function ($product){
            $product->slug = str_slug($product->title);
        });
    }

    public function category(){
        return $this->hasOne('App\Models\category');
    }


}