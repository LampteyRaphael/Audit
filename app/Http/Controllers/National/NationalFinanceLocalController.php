<?php

namespace App\Http\Controllers\National;

use App\District;
use App\Http\Controllers\Controller;
use App\income;
use App\incomeCategory;
use App\Locals;
use App\PostTithe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NationalFinanceLocalController extends Controller
{
    //National Viewing Local Account and what they will get

    public function daily($id){

        $DistrictName=District::findOrFail($id);

        $date=Carbon::now()->format('jS F,Y');

        $day=Carbon::now()->day;
        $month=Carbon::now()->month;
        $year=Carbon::now()->year;

       $locals=Locals::where('district_id',$id)->get();

       $localId=Locals::where('district_id',$id)->pluck('id')->all();

        $yearTotal=PostTithe::whereIn('local_id',$localId)
            ->whereDay('created_at',$day)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at', $year)
            ->pluck('amount')->sum();

        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=income::where('category_id',$taksId)->whereIn('local_id',$localId)
            ->whereDay('created_at',$day)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at', $year)
            ->pluck('amount')->sum();


        return view('headquarters.localTithe.index',compact(
            'DistrictName','id','locals','date','day','month','year','yearTotal','incomeTotal'));
    }


    public function dailypost(Request $request){

        $id=$request['id'];
        $DistrictName=District::findOrFail($id);

        $date = Carbon::parse($request['date'])->format('jS F,Y');

        $day=Carbon::parse($request['date'])->day;
        $month=Carbon::parse($request['date'])->month;
        $year=Carbon::parse($request['date'])->year;

        $locals=Locals::where('district_id',$id)->get();

        $localId=Locals::where('district_id',$id)->pluck('id')->all();

        $yearTotal=PostTithe::whereIn('local_id',$localId)
            ->whereDay('created_at',$day)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at', $year)
            ->pluck('amount')->sum();

        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=income::where('category_id',$taksId)->whereIn('local_id',$localId)
            ->whereDay('created_at',$day)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at', $year)
            ->pluck('amount')->sum();

        return view('headquarters.localTithe.index',compact(
            'DistrictName','id','locals','date','day','month','year','yearTotal','incomeTotal'));
    }

    public function monthly($id){

        $DistrictName=District::findOrFail($id);

        $date=Carbon::now()->format('F,Y');

        $month=Carbon::now()->month;
        $year=Carbon::now()->year;

        $locals=Locals::where('district_id',$id)->get();

        $localId=Locals::where('district_id',$id)->pluck('id')->all();

        $yearTotal=PostTithe::whereIn('local_id',$localId)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at', $year)
            ->pluck('amount')->sum();
        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=income::where('category_id',$taksId)->whereIn('local_id',$localId)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at', $year)
            ->pluck('amount')->sum();

        return view('headquarters.localTithe.month',compact(
            'DistrictName','id','locals','date','month','year','yearTotal','incomeTotal'));
    }

    public function monthlypost(Request $request){

        $id=$request['id'];
        $month=$request['month'];
        $year=$request['year'];
        $DistrictName=District::findOrFail($id);

        $date=Carbon::parse('01'.'-'.$month.'-'.$year)->format('F,Y');

        $locals=Locals::where('district_id',$id)->get();

        $localId=Locals::where('district_id',$id)->pluck('id')->all();

        $yearTotal=PostTithe::whereIn('local_id',$localId)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at', $year)
            ->pluck('amount')->sum();
        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=income::where('category_id',$taksId)->whereIn('local_id',$localId)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at', $year)
            ->pluck('amount')->sum();

        return view('headquarters.localTithe.month',compact(
            'DistrictName','id','locals','date','month','year','yearTotal','incomeTotal'));
    }



    public function year($id){

        $DistrictName=District::findOrFail($id);

        $date=Carbon::now()->format('F,Y');

        $year=Carbon::now()->year;

        $locals=Locals::where('district_id',$id)->get();

        $localId=Locals::where('district_id',$id)->pluck('id')->all();

        $yearTotal=PostTithe::whereIn('local_id',$localId)
            ->whereYear('created_at', $year)
            ->pluck('amount')->sum();
        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=income::where('category_id',$taksId)->whereIn('local_id',$localId)
            ->whereYear('created_at', $year)
            ->pluck('amount')->sum();

        return view('headquarters.localTithe.year',compact(
            'DistrictName','id','locals','date','year','yearTotal','incomeTotal'));
    }

    public function yearpost(Request $request){

        $id=$request['id'];

        $year=$request['year'];

        $DistrictName=District::findOrFail($id);

        $date=$year;

        $locals=Locals::where('district_id',$id)->get();

        $localId=Locals::where('district_id',$id)->pluck('id')->all();

        $yearTotal=PostTithe::whereIn('local_id',$localId)
            ->whereYear('created_at', $year)
            ->pluck('amount')->sum();
        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=income::where('category_id',$taksId)->whereIn('local_id',$localId)
            ->whereYear('created_at', $year)
            ->pluck('amount')->sum();

        return view('headquarters.localTithe.year',compact(
            'DistrictName','id','locals','date','year','yearTotal','incomeTotal'));

    }

    public function range($id){

        $date1=Carbon::now()->previousWeekendDay();

        $date2=Carbon::now();

        $DistrictName=District::findOrFail($id);

        $date=Carbon::parse($date1)->format('jS F,Y'). ' ' . ' To ' .Carbon::parse($date2)->format('jS F,Y');

        $locals=Locals::where('district_id',$id)->get();
        $localId=Locals::where('district_id',$id)->pluck('id')->all();

        $yearTotal=PostTithe::whereIn('local_id',$localId)
            ->whereBetween('created_at', [$date1,$date2])
            ->pluck('amount')->sum();
        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=income::where('category_id',$taksId)->whereIn('local_id',$localId)
            ->whereBetween('created_at', [$date1,$date2])
            ->pluck('amount')->sum();

        return view('headquarters.localTithe.range',compact(
            'DistrictName','date','id','locals','date1','date2','yearTotal','incomeTotal'));
    }


    public function rangepost(Request $request){

        $date1=$request['date1'];

        $date2=$request['date2'];

        $id=$request['id'];

        $DistrictName=District::findOrFail($id);

        $date=Carbon::parse($date1)->format('jS F,Y'). ' ' . ' To ' .Carbon::parse($date2)->format('jS F,Y');

        $locals=Locals::where('district_id',$id)->get();

        $localId=Locals::where('district_id',$id)->pluck('id')->all();

        $yearTotal=PostTithe::whereIn('local_id',$localId)
            ->whereBetween('created_at', [$date1,$date2])
            ->pluck('amount')->sum();
        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=income::where('category_id',$taksId)->whereIn('local_id',$localId)
            ->whereBetween('created_at', [$date1,$date2])
            ->pluck('amount')->sum();

        return view('headquarters.localTithe.range',compact(
            'DistrictName','date','id','locals','date1','date2','yearTotal','incomeTotal'));
    }





}
