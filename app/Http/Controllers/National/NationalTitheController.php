<?php

namespace App\Http\Controllers\National;

use App\Http\Controllers\Controller;
use App\PostTithe;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NationalTitheController extends Controller
{
    //
    public  function __construct()
    {
        date_default_timezone_set("Africa/Accra");
    }

    public function member($id){
        $username=User::findOrFail($id);
        $year=Carbon::now()->year;
        $tithe=PostTithe::where('local_id',$username->local_id)
            ->where('user_id',$username->id)
            ->whereYear('created_at',$year)->get();
        return view('headquarters.local.tithe.member',compact('year','username','tithe'));
    }

    public function memberpost(Request $request){

        $username=User::findOrFail($request['id']);

        $year=$request['year'];
        $tithe=PostTithe::where('local_id',$username->local_id)
            ->where('user_id',$username->id)
            ->whereYear('created_at',$request['year'])->get();
        return view('headquarters.local.tithe.member',compact('year','username','tithe'));
    }

    public function store(){

        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $day=Carbon::now()->day;

        $date=Carbon::now()->format('jS F, Y');

        $local_id=Auth::user()->local_id;

        $tithe=User::where('local_id',$local_id)
            ->where('is_active',1)->whereIn('id',PostTithe::pluck('user_id'))
            ->GetLatest();

        return view('headquarters.local.tithe.daily',compact('date','year','month','day'));
    }

    public function storepost(Request $request){

        $date=$request['date'];
        $year=Carbon::parse($date)->year;
        $month=Carbon::parse($date)->month;
        $day=Carbon::parse($date)->day;

        $date=Carbon::now()->format('jS F, Y');

        $local_id=Auth::user()->local_id;

        $tithe=User::where('local_id',$local_id)
            ->where('is_active',1)->whereIn('id',PostTithe::pluck('user_id'))
            ->GetLatest();

        return view('headquarters.local.tithe.daily',compact('year','month','day'));
    }

    public function janFeb($id){
        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $a=01;
        $b=02;
        $users=User::where('local_id',$id)->where('is_active',1)->get(['id','members_id']);

        return view('headquarters.local.tithe.janFebruary',compact('year','month','users','id','a','b'));

    }

    public function marApril($id){
        //return Carbon::now()->weekOfYear;
        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $a=03;
        $b=04;
        $users=User::where('local_id',$id)->where('is_active',1)->get(['id','members_id']);

        return view('headquarters.local.tithe.marchApril',compact('a','b','id','year','month','users'));
    }

    public function mayjune($id){
        //return Carbon::now()->weekOfYear;
        $id=$id;
        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $a=05;
        $b=06;
        $users=User::where('local_id',$id)->where('is_active',1)->GetLatest();

        return view('headquarters.local.tithe.mayjune',compact('a','id','b','id','year','month','users'));
    }

    public function julyAugust($id){
        //return Carbon::now()->weekOfYear;
        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $a=07;
        $b=8;
        $users=User::where('local_id',$id)->where('is_active',1)->get(['id','members_id']);

        return view('headquarters.local.tithe.julyAugust',compact('id','a','b','id','year','month','users'));
    }

    public function septOctober($id){
        //return Carbon::now()->weekOfYear;
        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $a=9;
        $b=10;
        $users=User::where('local_id',$id)->where('is_active',1)->get(['id','members_id']);

        return view('headquarters.local.tithe.septOctober',compact('id','a','b','id','year','month','users'));
    }

    public function novDecember($id){
        //return Carbon::now()->weekOfYear;
        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $a=11;
        $b=12;
        $users=User::where('local_id',$id)->where('is_active',1)->get(['id','members_id']);

        return view('headquarters.local.tithe.novDecember',compact('id','a','b','id','year','month','users'));
    }

    public function monthpost(Request $request){

        //return Carbon::now()->weekOfYear;
        $id=Auth::user()->local_id;
        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $users=User::where('local_id',Auth::user()->local_id)->where('is_active',1)->get(['id','members_id']);

        return view('headquarters.local.tithe.monthly',compact('id','year','month','users'));
    }

    public function midyear(){

        $year=Carbon::now()->year;
        $month=Carbon::now()->month;


        $local_id=Auth::user()->local_id;

        $tithe=User::where('local_id',$local_id)
            ->where('is_active',1)->whereIn('id',PostTithe::pluck('user_id'))
            ->GetLatest();

        return view('headquarters.local.tithe.midyear',compact('tithe','date','year','month'));
    }

    public function yearpost(Request $request){

        $year=$request['year'];
        $month=$request['month'];

        $date=$year;
        $a=$month;
        $b=$month+1;

        $local_id=Auth::user()->local_id;

        $tithe=User::where('local_id',$local_id)
            ->where('is_active',1)->whereIn('id',PostTithe::pluck('user_id'))
            ->GetLatest();

        return redirect()->back()->with(compact('date','b','a','year','month','date','tithe'));
    }



}
