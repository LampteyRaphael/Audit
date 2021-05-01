<?php

namespace App\Http\Controllers\Area;

use App\AreaExpenditure;
use App\AreaExpenditureCategory;
use App\AreaIncome;
use App\AreaIncomeCategory;
use App\District;
use App\Http\Controllers\Controller;
use App\income;
use App\incomeCategory;
use App\Locals;
use App\PostTithe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AreaReportController extends Controller
{
    //
    public  function __construct()
    {
        date_default_timezone_set("Africa/Accra");
    }

    public function post(Request $request){

        $post=$request->all();
        AreaIncome::create($post);
        return redirect()->back()->with(['success1'=>'Successfully Posted Income. Thank you']);

    }

    public function postexpenditure(Request $request){
        $post=$request->all();

        AreaExpenditure::create($post);

        return redirect()->back()->with(['success1'=>'Successfully Posted Income. Thank you']);
    }

    public function dailyReport(){
            $year=Carbon::now()->year;
            $month=Carbon::now()->month;
            $day=Carbon::now()->day;

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


        $date=Carbon::now()->format('jS F,Y');

        return view('area.reports.dailyReport',compact('year','month','day','incomeCategory','total','incomeCategoryE','totalE','date'));
    }

    public function monthlyReport(){
        $year=Carbon::now()->year;
        $month=Carbon::now()->month;


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

    public function midYearReport(){

        $year=Carbon::now()->year;
        $month=Carbon::now()->month;

        $area_id=Auth::user()->area_id;
        $incomeCategory=AreaIncomeCategory::where("area_id",$area_id)->orwhere("area_id",0)->get();

        $total=AreaIncome::where("area_id",$area_id)
            ->whereYear('created_at',$year)
            ->whereMonth('created_at','<=',6)
            ->pluck('amount')->sum();

        $incomeCategoryE=AreaExpenditureCategory::where("area_id",$area_id)->orwhere("area_id",0)->get();
        $totalE=AreaExpenditure::where("area_id",$area_id)

            ->whereYear('created_at',$year)
            ->whereMonth('created_at','<=',6)
            ->pluck('amount')->sum();

        return view('area.reports.midYearReport',compact('year','month','incomeCategory','total','incomeCategoryE','totalE'));
    }



    public function YearlyReport(){
        $year=Carbon::now()->year;
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
