<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaIncomeCategory extends Model
{
    //
    protected $fillable=[
        'name',
        'area_id'
    ];

    public function getNameAttribute($value){

        return ucwords($value);
    }

    public function setNameAttribute($value){

        return $this->attributes['name']=ucwords($value);
    }
}
