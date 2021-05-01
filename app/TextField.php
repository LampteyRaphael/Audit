<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TextField extends Model
{
    //text messages to every users
    protected $fillable=[
        'user_id',
        'local_id',
        'text',
        'reply',
        'region_id'
    ];


    public function user(){

        return $this->hasMany('App\User');
    }

    public function photo(){

        return  $this->belongsTo('App\Photo')->withDefault();
    }

}
