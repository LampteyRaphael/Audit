<?php

namespace App\Http\Controllers\District;

use App\District;
use App\Http\Controllers\Controller;
use App\income;
use App\incomeCategory;
use App\Locals;
use App\PostTithe;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DistrictTransferController extends Controller
{

    public  function __construct()
    {
        date_default_timezone_set("Africa/Accra");
    }

    public  function index($id){
        try {
        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $a=$month;
        $day=Carbon::now()->format('d');
        $dates=strtoupper(Carbon::parse($day.'-'.$month.'-'.$year)->format('F, Y'));
        $users=User::where('local_id',$id)->where('district_id',Auth::user()->district_id)->where('is_active',1)->GetLatest();
        $localName=Locals::where('id',$id)->where('district_id',Auth::user()->district_id)->pluck('name')->first();
    }catch (ModelNotFoundException $exception){

return back()->withError('User not found by ID ' . $id)->withInput();
}
        return view('districts.chart.index', compact('month','a','id','users','year','localName','dates'));
    }


    public function store(Request $request,$id){
        try {
        $year=$request['year'];
        $month=$request['month'];
        $day=Carbon::now()->format('d');
        $dates=strtoupper(Carbon::parse($day.'-'.$month.'-'.$year)->format('F Y'));
        $a= $month;
        $users=User::where('local_id',$id)->where('is_active',1)->where('district_id',Auth::user()->district_id)->GetLatest();
        $localName=Locals::where('id',$id)->pluck('name')->first();
        }catch (ModelNotFoundException $exception){

            return back()->withError('User not found by ID ' . $id)->withInput();
        }
        return view('districts.chart.index',compact('year','month','a','id','users','localName','dates'));

    }


    public function index2(){

        //fetching tithe posted every weeks and days
        $local_id=Locals::where('district_id',Auth::user()->district_id)->pluck('id');
        $date1=Carbon::now()->previousWeekendDay();
        $date2=Carbon::now();
        $date=Carbon::parse($date1)->format('jS F,Y'). ' ' . ' To ' .Carbon::parse($date2)->format('jS F,Y');

        $postTithe=DB::table('post_tithes')->whereIn('local_id',$local_id)->whereBetween('created_at',[$date1,$date2])->pluck('amount')->sum();

        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $taksIdRange=DB::table('incomes')->whereIn('local_id',$local_id)->where('category_id',$taksId)->whereBetween('created_at',[$date1,$date2])->pluck('amount')->sum();

        return view('districts.chart.range',compact('date','date1','date2','postTithe','taksIdRange'));
    }


    public function store2(Request $request){

        //fetching tithe posted every weeks and days
        $local_id=Locals::where('district_id',Auth::user()->district_id)->pluck('id');
        $date1=$request['date1'];
        $date2=$request['date2'];
        $date=Carbon::parse($date1)->format('jS F,Y'). ' ' . ' To ' .Carbon::parse($date2)->format('jS F,Y');

        $postTithe=DB::table('post_tithes')->whereIn('local_id',$local_id)->whereBetween('created_at',[$date1,$date2])->pluck('amount')->sum();

        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $taksIdRange=DB::table('incomes')->whereIn('local_id',$local_id)->where('category_id',$taksId)->whereBetween('created_at',[$date1,$date2])->pluck('amount')->sum();

        return view('districts.chart.range',compact('date','date1','date2','postTithe','taksIdRange'));
    }



















}
