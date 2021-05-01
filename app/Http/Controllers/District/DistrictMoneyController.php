<?php

namespace App\Http\Controllers\District;

use App\Attendance;
use App\District;
use App\DistrictExpenditure;
use App\DistrictExpenditureCategory;
use App\DistrictIncome;
use App\DistrictIncomeCategory;
use App\Http\Controllers\Controller;
use App\income;
use App\incomeCategory;
use App\Locals;
use App\PostTithe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DistrictMoneyController extends Controller
{
    public  function __construct()
    {
        date_default_timezone_set("Africa/Accra");
    }
    public function daily(){
        $id=Auth::user()->district_id;
        $day=Carbon::now()->day;
        $month=Carbon::now()->month;
        $year=Carbon::now()->year;
        $date=Carbon::parse($day.'-'.$month.'-'.$year)->format('jS F,Y');

        $incomeCategory=DistrictIncomeCategory::where("district_id",$id)->orwhere("district_id",0)->get();

        $total=DistrictIncome::where("district_id",$id)
            ->whereDay('created_at',$day)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        $incomeCategoryE=DistrictExpenditureCategory::where("district_id",$id)->orwhere("district_id",0)->get();

        $totalE=DistrictExpenditure::where("district_id",$id)
            ->whereDay('created_at',$day)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        return view('districts.money.dailymoney',compact('date','incomeCategory','total','incomeCategoryE','totalE','year','month','day'));

    }


    public function dailypost(Request $request){

        $id=Auth::user()->district_id;
        $day=Carbon::parse($request['date'])->day;
        $month=Carbon::parse($request['date'])->month;
        $year=Carbon::parse($request['date'])->year;
        $date=Carbon::parse($day.'-'.$month.'-'.$year)->format('jS F,Y');

        $incomeCategory=DistrictIncomeCategory::where("district_id",$id)->orwhere("district_id",0)->get();

        $total=DistrictIncome::where("district_id",$id)
            ->whereDay('created_at',$day)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();


        $incomeCategoryE=DistrictExpenditureCategory::where("district_id",$id)->orwhere("district_id",0)->get();

        $totalE=DistrictExpenditure::where("district_id",$id)
            ->whereDay('created_at',$day)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        return view('districts.money.dailymoney',compact('date','incomeCategory','total','incomeCategoryE','totalE','year','month','day'));

    }


    public function range(){
        $id=Auth::user()->district_id;
        $day=Carbon::now()->day;
        $month=Carbon::now()->month;
        $year=Carbon::now()->year;

        $from=Carbon::yesterday()->format('d-m-Y');
        $to=Carbon::now()->format('d-m-Y');
        $date=Carbon::parse($from)->format('jS F, Y').'-'.Carbon::parse($to)->format('jS F,Y');

        $incomeCategory=DistrictIncomeCategory::where("district_id",$id)->orwhere("district_id",0)->get();

        $total=DistrictIncome::where("district_id",$id)
            ->whereBetween('created_at',[$from,$to])
            ->pluck('amount')->sum();

        $incomeCategoryE=DistrictExpenditureCategory::where("district_id",$id)->orwhere("district_id",0)->get();

        $totalE=DistrictExpenditure::where("district_id",$id)
            ->whereBetween('created_at',[$from,$to])
            ->pluck('amount')->sum();

        return view('districts.money.range',compact('from','to','date','incomeCategory','total','incomeCategoryE','totalE','year','month','day'));

    }

    public function rangepost(Request $request){
        $id=Auth::user()->district_id;

        $from=$request['from'];
        $to=$request['to'];
        $date=Carbon::parse($from)->format('jS F, Y').'-'.Carbon::parse($to)->format('jS F,Y');
        $incomeCategory=DistrictIncomeCategory::where("district_id",$id)->orwhere("district_id",0)->get();
        $total=DistrictIncome::where("district_id",$id)
            ->whereBetween('created_at',[$from,$to])
            ->pluck('amount')->sum();

        $incomeCategoryE=DistrictExpenditureCategory::where("district_id",$id)->orwhere("district_id",0)->get();

        $totalE=DistrictExpenditure::where("district_id",$id)
            ->whereBetween('created_at',[$from,$to])
            ->pluck('amount')->sum();


        return view('districts.money.range',compact('from','to','date','incomeCategory','total','incomeCategoryE','totalE','year','month','day'));

    }




    public function yearly(){

        $id=Auth::user()->district_id;
        $year=Carbon::now()->year;
        $incomeCategory=DistrictIncomeCategory::where("district_id",$id)->orwhere("district_id",0)->get();

        $total=DistrictIncome::where("district_id",$id)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();


        $incomeCategoryE=DistrictExpenditureCategory::where("district_id",$id)->orwhere("district_id",0)->get();

        $totalE=DistrictExpenditure::where("district_id",$id)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        return view('districts.money.yearlyMoney',compact('year','incomeCategory','total','incomeCategoryE','totalE'));

    }

    public function yearlypost(Request $request){

        $id=Auth::user()->district_id;

        $year=$request['year'];
        $incomeCategory=DistrictIncomeCategory::where("district_id",$id)->orwhere("district_id",0)->get();

        $total=DistrictIncome::where("district_id",$id)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();


        $incomeCategoryE=DistrictExpenditureCategory::where("district_id",$id)->orwhere("district_id",0)->get();

        $totalE=DistrictExpenditure::where("district_id",$id)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        return view('districts.money.yearlyMoney',compact('year','incomeCategory','total','incomeCategoryE','totalE'));

    }

    public function monthly(){

        $id=Auth::user()->district_id;

        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $day=Carbon::now()->day;

        $date=Carbon::parse($day.'-'.$month.'-'.$year)->format('F,Y');

        $incomeCategory=DistrictIncomeCategory::where("district_id",$id)->orwhere("district_id",0)->get();

        $total=DistrictIncome::where("district_id",$id)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();


        $incomeCategoryE=DistrictExpenditureCategory::where("district_id",$id)->orwhere("district_id",0)->get();

        $totalE=DistrictExpenditure::where("district_id",$id)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        return view('districts.money.monthlyMoney',compact('date','incomeCategory','total','month','incomeCategoryE','totalE','year'));

    }

    public function monthlypost(Request $request){

        $id=Auth::user()->district_id;

        $year=$request['year'];
        $month=$request['month'];
        $day=Carbon::now()->day;
        $date=Carbon::parse($day.'-'.$month.'-'.$year)->format('F,Y');
        $incomeCategory=DistrictIncomeCategory::where("district_id",$id)->orwhere("district_id",0)->get();

        $total=DistrictIncome::where("district_id",$id)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();


        $incomeCategoryE=DistrictExpenditureCategory::where("district_id",$id)->orwhere("district_id",0)->get();

        $totalE=DistrictExpenditure::where("district_id",$id)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        return view('districts.money.monthlyMoney',compact('date','incomeCategory','total','month','incomeCategoryE','totalE','year'));

    }

    public function mid(){

        $id=Auth::user()->district_id;

        $year=Carbon::now()->year;
        $incomeCategory=DistrictIncomeCategory::where("district_id",$id)->orwhere("district_id",0)->get();

        $total=DistrictIncome::where("district_id",$id)
            ->whereMonth('created_at','<=',6)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        $incomeCategoryE=DistrictExpenditureCategory::where("district_id",$id)->orwhere("district_id",0)->get();

        $totalE=DistrictExpenditure::where("district_id",$id)
            ->whereMonth('created_at','<=',6)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();


        return view('districts.money.mid',compact('incomeCategory','total','incomeCategoryE','totalE','year'));

    }

    public function attendance(){
        $id=Auth::user()->local_id;

        $month1=Carbon::now()->day.'-'.Carbon::now()->month.'-'.Carbon::now()->year;

        $month2=Carbon::now();

        $category="sunday";

        $date1=Carbon::parse($month1)->format('jS F,Y');

        $date2=Carbon::parse($month2)->format('jS F,Y');

        $year=' From ' . ' ' . $date1.' ' . ' to '. $date2;

        $post=Attendance::where('local_id',$id)->where('category',$category)
            ->whereDay('created_at',Carbon::now()->day)
            ->whereMonth('created_at',Carbon::now()->month)
            ->whereYear('created_at',Carbon::now()->year)
            ->get();

        $localName=Auth::user()->local->name;
        $category=strtoupper($category);
        $locals=Locals::where('district_id',Auth::user()->district_id)->pluck('name','id');

        return view('districts.attendance.index',compact('post','year','category','localName','locals'));
    }

    public function attendancepost(Request $request){
        $id=$request['local'];

        $month1=$request['from'];

        $month2=$request['to'];

        $category=$request['category'];

        $date1=Carbon::parse($month1)->format('jS F,Y');

        $date2=Carbon::parse($month2)->format('jS F,Y');

        $year=' From ' . ' ' . $date1.' ' . ' -'. $date2;

        $post=Attendance::where('local_id',$id)->where('category',$category)

            ->whereBetween('created_at',[$month1 ,$month2])
            ->get();

        $localName=Auth::user()->local->name;
        $category=strtoupper($category);
        $locals=Locals::where('district_id',Auth::user()->district_id)->pluck('name','id');

        return view('districts.attendance.index',compact('post','year','category','localName','locals'));
    }
}
