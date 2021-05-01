<?php

namespace App\Http\Controllers\Area;

use App\Http\Controllers\Controller;
use App\income;
use App\incomeCategory;
use Illuminate\Http\Request;
use App\AreaExpenditure;
use App\AreaExpenditureCategory;
use App\AreaIncome;
use App\AreaIncomeCategory;
use App\District;
use App\Locals;
use App\PostTithe;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class FinanceDailyController extends Controller
{
    //

    public  function __construct()
    {
        date_default_timezone_set("Africa/Accra");
    }

    public function store(Request $request){

        $year=Carbon::parse($request['date'])->year;
        $month=Carbon::parse($request['date'])->month;
        $day=Carbon::parse($request['date'])->day;
        $area_id=Auth::user()->area_id;
        $incomeCategory=AreaIncomeCategory::where("area_id",$area_id)->orwhere("area_id",0)->get();

        $total=AreaIncome::where("area_id",$area_id)
            ->whereYear('created_at',$year)
            ->whereMonth('created_at',$month)
            ->whereDay('created_at',$day)
            ->pluck('amount')->sum();

        $incomeCategoryE=AreaExpenditureCategory::where("area_id",$area_id)->orwhere("area_id",0)->get();

        $totalE=AreaExpenditure::where("area_id",$area_id)
            ->whereYear('created_at',$year)
            ->whereMonth('created_at',$month)
            ->whereDay('created_at',$day)
            ->pluck('amount')->sum();

        $date=Carbon::parse($day.'-'.$month.'-'.$year)->format('jS F,Y');

        return view('area.reports.dailyReport',compact('year','month','day','incomeCategory','total','incomeCategoryE','totalE','date'));

    }


    public function store2(Request $request){

        $year=$request['year'];
        $month=$request['month'];

        $area_id=Auth::user()->area_id;

        $incomeCategory=AreaIncomeCategory::where("area_id",$area_id)->orwhere("area_id",0)->get();

        $total=AreaIncome::where("area_id",$area_id)
            ->whereYear('created_at',$year)
            ->whereMonth('created_at',$month)
            ->pluck('amount')->sum();

        $incomeCategoryE=AreaExpenditureCategory::where("area_id",$area_id)->orwhere("area_id",0)->get();

        $totalE=AreaExpenditure::where("area_id",$area_id)
            ->whereYear('created_at',$year)
            ->whereMonth('created_at',$month)
            ->pluck('amount')->sum();

        $d=Carbon::now()->day;
        $date=Carbon::parse($d.'-'.$month.'-'.$year)->format('F,Y');

        return view('area.reports.monthlyReport',compact('year','month','incomeCategory','total','incomeCategoryE','totalE','date'));

    }


    public function store3(Request $request){
        $year=$request['year'];
        $area_id=Auth::user()->area_id;

        $incomeCategory=AreaIncomeCategory::where("area_id",$area_id)->orwhere("area_id",0)->get();

        $total=AreaIncome::where("area_id",$area_id)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        $incomeCategoryE=AreaExpenditureCategory::where("area_id",$area_id)->orwhere("area_id",0)->get();

        $totalE=AreaExpenditure::where("area_id",$area_id)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        return view('area.reports.YearlyReport',compact('incomeCategory','total','incomeCategoryE','totalE','year'));

    }
}
