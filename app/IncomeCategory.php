<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class incomeCategory extends Model
{
    //
    protected $fillable=[
        'name',
        'local_id'
    ];

    public function setNameAttribute($value){


        return $this->attributes['name']=ucwords($value);

    }

    public function getNameAttribute($value){

        return ucwords($value);
    }

    public function locals(){

        return $this->belongsTo('App\Locals')->withDefault();
    }
}
