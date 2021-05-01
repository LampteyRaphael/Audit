<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocalSMS extends Model
{
    //sending sms to your church members

    protected  $table='local_s_m_s';
    protected  $fillable=[
        'smsGeneratedCode',
        'smsVerificationCode',
        'amount',
        'smsToPost',
        'smsPosted',
        'local_id',
        'is_active',
        'block',
    ];

}
