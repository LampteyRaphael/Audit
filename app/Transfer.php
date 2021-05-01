<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    //
    protected $fillable=
    [
        'local_id',
        'district_id',
        'area_id',
        'region_id',
        'user_id',
        'to_local'
    ];


    public function user(){

        return  $this->belongsTo(User::class);
    }

    public function photo(){

        return  $this->belongsTo(Photo::class);

    }

    public function local(){

        return $this->belongsTo(Locals::class);
    }

    public function district(){

        return $this->belongsTo(District::class);
    }

    public function area(){

        return $this->belongsTo(Area::class);
    }

    public function region(){

        return $this->belongsTo(Region::class);
    }


    public static function scopeGetLatest($query)
    {
        return  $query->orderBy('created_at','desc')->paginate(50);
    }


}
