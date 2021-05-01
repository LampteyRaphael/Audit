<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DistrictIncome extends Model
{
    //
    protected $fillable=[
        'district_income_categories_id',
        'district_id',
        'amount',
        'description',
        'created_at',
    ];

    public function getNameAttribute($value){

        return ucwords($value);
    }

    public function setNameAttribute($value){

        return $this->attributes['name']=ucwords($value);
    }

}
