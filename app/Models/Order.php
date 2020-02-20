<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function customer(){
        return $this->belongsTo('App\Models\User');
    }

    public function processor(){
        return $this->hasOne('App\Models\User', 'processed_by');
    }

    public function products(){
        return $this->hasMany('App\Models\OrderProduct');
    }

}
