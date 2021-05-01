<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostCircularForDistrictAdmins extends Model
{
    //circular for only district admins
    protected $fillable=['name','created_at','updated_at'];
}
