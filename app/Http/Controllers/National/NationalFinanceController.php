<?php

namespace App\Http\Controllers\National;

use App\Area;
use App\District;
use App\Http\Controllers\Controller;
use App\income;
use App\incomeCategory;
use App\Locals;
use App\PostTithe;
use App\Region;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class NationalFinanceController extends Controller
{
    //
    public  function __construct()
    {
        date_default_timezone_set("Africa/Accra");
    }

    public function daily(){

        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $day=Carbon::now()->day;
        $regions=Region::orderBy('name','asc')->paginate(20);
        $date=Carbon::now()->format('jS F,Y');

        //over all total for tithe in a specific day
        $yearTotal=PostTithe::
             whereDay('created_at',$day)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->pluck('amount')->sum();
        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=income::where('category_id',$taksId)
            ->whereDay('created_at',$day)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        return view('headquarters.finance.daily',compact('taksId','date','regions','day','month','year','yearTotal','incomeTotal'));

    }

    public function dailypost(Request $request)
    {

        $year = Carbon::parse($request['date'])->year;
        $month = Carbon::parse($request['date'])->month;
        $day = Carbon::parse($request['date'])->day;
        $date=Carbon::parse($request['date'])->format('jS F,Y');
        $regions=Region::orderBy('name','asc')->paginate(20);
        //over all total for tithe in a specific day
        $yearTotal=PostTithe::
        whereDay('created_at',$day)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->pluck('amount')->sum();
        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=income::where('category_id',$taksId)
            ->whereDay('created_at',$day)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        return view('headquarters.finance.daily',compact('taksId','date','regions','day','month','year','yearTotal','incomeTotal'));
    }

    public function monthly(){
        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $regions=Region::orderBy('name','asc')->paginate(20);
        $date=Carbon::now()->format('F,Y');

        $yearTotal=PostTithe::whereMonth('created_at', $month)->whereYear('created_at', $year)->pluck('amount')->sum();
        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=income::where('category_id',$taksId)->whereMonth('created_at',$month)->whereYear('created_at',$year)->pluck('amount')->sum();
        return view('headquarters.finance.monthly',compact('taksId','year','month','regions','date','yearTotal','incomeTotal'));
    }

    public function monthlypost(Request $request){
        $year=$request['year'];
        $month=$request['month'];
        $regions=Region::orderBy('name','asc')->paginate(20);
        $date=Carbon::parse('01'.'-'.$month.'-'.$year)->format('F,Y');
        //over all total for tithe in a specific day
        $yearTotal=PostTithe::whereMonth('created_at', $month)->whereYear('created_at', $year)->pluck('amount')->sum();
        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');
        $incomeTotal=income::where('category_id',$taksId)->whereMonth('created_at',$month)->whereYear('created_at',$year)->pluck('amount')->sum();
        return view('headquarters.finance.monthly',compact('taksId','year','month','regions','date','yearTotal','incomeTotal'));

    }

    public function range(){
        $regions=Region::orderBy('name','asc')->paginate(20);
        $date1=Carbon::now()->previousWeekendDay();
        $date2=Carbon::now();
        $date=Carbon::parse($date1)->format('jS F,Y'). ' ' . ' To ' .Carbon::parse($date2)->format('jS F,Y');
        //over all total for tithe in a specific day
        $yearTotal=PostTithe::whereBetween('created_at', [$date1,$date2])->pluck('amount')->sum();
        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');
        $incomeTotal=income::where('category_id',$taksId)->whereBetween('created_at', [$date1,$date2])->pluck('amount')->sum();
        return view('headquarters.finance.range',compact('taksId','date2','date1','regions','date','yearTotal','incomeTotal'));

    }

    public function rangepost(Request $request){
        $regions=Region::orderBy('name','asc')->paginate(20);
        $date= Carbon::parse($request['date1'])->format(' jS F, Y ') . ' ' . ' To ' . ' '. Carbon::parse($request['date2'])->format('jS F,Y');
        $date1=$request['date1'];
        $date2=$request['date2'];
        //over all total for tithe in a specific day
        $yearTotal=PostTithe::whereBetween('created_at', [$date1,$date2])->pluck('amount')->sum();
        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');
        $incomeTotal=income::where('category_id',$taksId)->whereBetween('created_at', [$date1,$date2])->pluck('amount')->sum();
        return view('headquarters.finance.range',compact('taksId','date2','date1','regions','date','yearTotal','incomeTotal'));
    }

    public function year(){
        $year=Carbon::now()->year;
        $regions=Region::orderBy('name','asc')->paginate(20);
        $date=$year;
        //over all total for tithe in a specific day
        $yearTotal=PostTithe::whereYear('created_at', $year)->pluck('amount')->sum();
        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');
        $incomeTotal=income::where('category_id',$taksId)->whereYear('created_at',$year)->pluck('amount')->sum();
        return view('headquarters.finance.year',compact('taksId','date','regions','year','yearTotal','incomeTotal'));


    }

    public function yearlypost(Request $request){
        $year=$request['year'];
        $regions=Region::orderBy('name','asc')->paginate(20);
        $date=$year;
        //over all total for tithe in a specific day
        $yearTotal=PostTithe::whereYear('created_at', $year)->pluck('amount')->sum();
        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');
        $incomeTotal=income::where('category_id',$taksId)->whereYear('created_at',$year)->pluck('amount')->sum();
        return view('headquarters.finance.year',compact('taksId','date','regions','year','yearTotal','incomeTotal'));
    }

}
