<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LanguagesInGhana extends Model
{
    //
    protected $fillable=['name'];

    public function getNameAttribute($value){

        return ucwords($value);
    }

    public function setNameAttribute($value){

        return $this->attributes['name']=ucwords($value);
    }

    public static function scopeGetLatest($query)
    {
        return  $query->orderBy('name','ASC')->pluck('name','name')->all();

    }

}
