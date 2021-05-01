<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    //
    protected $fillable=[
        'region_id',
        'name',
        'area_code',
        'date'
    ];


    public function getNameAttribute($value){

        return strtoupper($value);
    }

    public function setNameAttribute($value){

        return $this->attributes['name']=strtoupper($value);
    }

    public function district(){

        return $this->belongsTo('App\District')->withDefault();
    }

    public function scopeGetLatest($value)
    {
        return $value->orderBy('area_code','asc')->paginate(50);
    }


    public function  region(){

        return $this->belongsTo(Region::class)->withDefault();;
    }

    public function transfer(){

        return $this->belongsTo(Transfer::class);
    }
}
