<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DistrictExpenditureCategory extends Model
{
    //
    protected $fillable=[
        'name',
        'district_id'
    ];

    public function getNameAttribute($value){

        return ucwords($value);
    }

    public function setNameAttribute($value){

        return $this->attributes['name']=ucwords($value);
    }

}
