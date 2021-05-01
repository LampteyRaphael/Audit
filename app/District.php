<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    //district
    protected $fillable=[
      'name',
      'area_id',
      'district_code',
      'date'
    ];

    public function getNameAttribute($value){

        return strtoupper($value);
    }

    public function setNameAttribute($value){

        return $this->attributes['name']=strtoupper($value);
    }

    public function locals(){

        return $this->belongsTo(Locals::class)->withDefault();
    }

    public function area(){

        return $this->belongsTo(Area::class)->withDefault();
    }

    public function scopeGetLatest($value)
    {
        return $value->orderBy('district_code','asc')->paginate(50);
    }
}
