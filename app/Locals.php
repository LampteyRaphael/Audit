<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locals extends Model
{
    //
    protected $fillable=[
        'name',
        'district_id',
        'local_code',
        'date'
    ];

    public function getNameAttribute($value){

        return strtoupper($value);
    }

    public function setNameAttribute($value){

        return $this->attributes['name']=strtoupper($value);
    }

    public function user(){

        return $this->hasMany(User::class);
    }

      public function photo(){

      return  $this->belongsTo(Photo::class);
    }

    public function scopeGetLatest($value)
    {
        return $value->orderBy('local_code','asc')->paginate(50);
    }

    public function district(){

        return $this->belongsTo(District::class);
    }


}
