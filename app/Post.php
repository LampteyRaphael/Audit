<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //attribute for post users
    protected $fillable=[
        'user_id',
        'category_id',
        'photo_id',
        'title',
        'body'
        ];

    public function user(){

      return  $this->belongsTo('App\User');
    }

    public function photo(){

        return  $this->belongsTo('App\Photo');
    }

    public function category(){

        return  $this->belongsTo('App\Category');
    }

//    public function getUser_idAttribute($value){
//
//        return ucwords($value);
//    }

//    public function setNameAttribute($value){
//
//        return $this->attributes['name']=ucfirst($value);
//    }


}
