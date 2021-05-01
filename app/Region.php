<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    // region
    protected $fillable=[
        'name','id'
    ];

    public function getNameAttribute($value){

        return strtoupper($value);
    }

    public function setNameAttribute($value){

        return $this->attributes['name']=strtoupper($value);
    }

    public function area(){

        return $this->belongsTo('App\Area');
    }

    public function scopeGetLatest($value){

        return $value->orderBy('name','asc')->get();
    }


}
