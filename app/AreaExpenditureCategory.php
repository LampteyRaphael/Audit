<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaExpenditureCategory extends Model
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

public function category(){

   return $this->belongsTo(Expenditure::class);
}
}
