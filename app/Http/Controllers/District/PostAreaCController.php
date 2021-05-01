<?php

namespace App\Http\Controllers\District;

use App\DistrictExpenditure;
use App\DistrictIncome;
use App\DistrictIncomeCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\DistrictExpenditureRequest;
use App\income;
use App\incomeCategory;
use App\Locals;
use App\PostTithe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostAreaCController extends Controller
{
    //
    public  function __construct()
    {
        date_default_timezone_set("Africa/Accra");
    }

    public function post(DistrictExpenditureRequest $request){

       $post=$request->all();

       DistrictIncome::create($post);

        return redirect()->back()->with(['success1'=>'Successfully Posted Income. Thank you']);

    }

    public function postexpenditure(DistrictExpenditureRequest $request){
        $post=$request->all();

        DistrictExpenditure::create($post);

        return redirect()->back()->with(['success1'=>'Successfully Posted Income. Thank you']);
    }

    public function dailyReport(){

        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $day=Carbon::now()->day;

        $id=Auth::user()->district_id;
        $locals=Locals::where('district_id',$id)->GetLatest();


        $locals_id=Locals::where('district_id',$id)->pluck('id');

        $yearTotal=PostTithe::whereIn('local_id',$locals_id)
            ->whereDay('created_at',$day)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=DB::table('incomes')->where('category_id',$taksId)
            ->whereDay('created_at',$day)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->whereIn('local_id',$locals_id)->pluck('amount')->sum();

        $date=Carbon::parse($day.'-'.$month.'-'.$year)->format('jS F Y');

        return view('districts.reports.dailyReport',compact('date','yearTotal','locals','year','month','day','incomeTotal','taksId'));
    }

    public function anotherdailypsots(Request $request){

        $day=Carbon::parse($request['date'])->day;
        $month=Carbon::parse($request['date'])->month;
        $year=Carbon::parse($request['date'])->year;
        $date=Carbon::parse($day.'-'.$month.'-'.$year)->format('jS F,Y');

        $id=Auth::user()->district_id;
        $locals=Locals::where('district_id',$id)->GetLatest();

        $locals_id=Locals::where('district_id',$id)->pluck('id');

        $yearTotal=PostTithe::whereIn('local_id',$locals_id)
            ->whereDay('created_at',$day)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=DB::table('incomes')->where('category_id',$taksId)
            ->whereDay('created_at',$day)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->whereIn('local_id',$locals_id)->pluck('amount')->sum();

        return view('districts.reports.dailyReport',compact('date','yearTotal','locals','year','month','day','incomeTotal','taksId'));
    }



    public function monthlyReport(){
            $year=Carbon::now()->year;
            $month=Carbon::now()->month;
            $day=Carbon::now()->day;
        $date=Carbon::parse($day.'-'.$month.'-'.$year)->format('F,Y');

        $id=Auth::user()->district_id;
        $locals=Locals::where('district_id',$id)->GetLatest();


        $locals_id=Locals::where('district_id',$id)->pluck('id');

        $yearTotal=PostTithe::whereIn('local_id',$locals_id)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=DB::table('incomes')->where('category_id',$taksId)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->whereIn('local_id',$locals_id)->pluck('amount')->sum();


        return view('districts.reports.monthlyReport',compact('yearTotal','year','locals','taksId','incomeTotal','month','date'));
    }

    public function psotM(Request $request){
            $post=$request->all();
            $year=$post['year'];
            $month=$post['month'];
            $day=Carbon::now()->day;

        $date=Carbon::parse($day.'-'.$month.'-'.$year)->format('F,Y');

        $id=Auth::user()->district_id;
        $locals=Locals::where('district_id',$id)->GetLatest();
        $locals_id=Locals::where('district_id',$id)->pluck('id');

        $yearTotal=PostTithe::whereIn('local_id',$locals_id)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=DB::table('incomes')->where('category_id',$taksId)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->whereIn('local_id',$locals_id)->pluck('amount')->sum();

        return view('districts.reports.monthlyReport',compact('yearTotal','locals','year','month','incomeTotal','taksId','date'));
    }



    public function midYearReport(){

        $year=Carbon::now()->year;
        $id=Auth::user()->district_id;
        $locals=Locals::where('district_id',$id)->GetLatest();
        $locals_id=Locals::where('district_id',$id)->pluck('id');

        $yearTotal=PostTithe::whereIn('local_id',$locals_id)
            ->whereMonth('created_at','<=',6)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=DB::table('incomes')
            ->whereMonth('created_at','<=',6)
            ->whereYear('created_at',$year)
            ->where('category_id',$taksId)
            ->whereIn('local_id',$locals_id)
            ->pluck('amount')->sum();

        return view('districts.reports.midYearReport',compact('yearTotal','year','locals','taksId','incomeTotal'));
    }

    public function YearlyReport(){

        $year=Carbon::now()->year;
        $id=Auth::user()->district_id;
        $locals=Locals::where('district_id',$id)->GetLatest();
        $locals_id=Locals::where('district_id',$id)->pluck('id');

        $yearTotal=PostTithe::whereIn('local_id',$locals_id)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=DB::table('incomes')
            ->whereYear('created_at',$year)
            ->where('category_id',$taksId)
            ->whereIn('local_id',$locals_id)
            ->pluck('amount')->sum();

        return view('districts.reports.YearlyReport',compact('yearTotal','year','locals','taksId','incomeTotal'));
    }


    public function yearReportPost(Request $request){
        $year=$request['year'];
        $id=Auth::user()->district_id;
        $locals=Locals::where('district_id',$id)->GetLatest();
        $locals_id=Locals::where('district_id',$id)->pluck('id');

        $yearTotal=PostTithe::whereIn('local_id',$locals_id)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=DB::table('incomes')
            ->whereYear('created_at',$year)
            ->where('category_id',$taksId)
            ->whereIn('local_id',$locals_id)
            ->pluck('amount')->sum();

        return view('districts.reports.YearlyReport',compact('yearTotal','year','locals','taksId','incomeTotal'));
    }




    public function rangeReport(){
        $from= Carbon::yesterday()->format('d-m-Y');
        $to=Carbon::now()->format('d-m-Y');

        $date=Carbon::parse($from)->format('jS F, Y').'-'.Carbon::parse($to)->format('jS F,Y');

        $id=Auth::user()->district_id;
        $locals=Locals::where('district_id',$id)->GetLatest();
        $locals_id=Locals::where('district_id',$id)->pluck('id');

        $yearTotal=PostTithe::whereIn('local_id',$locals_id)
            ->whereBetween('created_at',[$from,$to])
            ->pluck('amount')->sum();

        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=DB::table('incomes')
            ->whereBetween('created_at',[$from,$to])
            ->where('category_id',$taksId)
            ->whereIn('local_id',$locals_id)
            ->pluck('amount')->sum();


        return view('districts.reports.range',compact('from','to','date','yearTotal','locals','incomeTotal','taksId'));
    }

    public function rangeReportpost(Request $request){

        $from=$request['from'];
        $to=$request['to'];
        $date=Carbon::parse($from)->format('jS F, Y').'-'.Carbon::parse($to)->format('jS F,Y');

        $id=Auth::user()->district_id;
        $locals=Locals::where('district_id',$id)->GetLatest();
        $locals_id=Locals::where('district_id',$id)->pluck('id');

        $yearTotal=PostTithe::whereIn('local_id',$locals_id)
            ->whereBetween('created_at',[$from,$to])
            ->pluck('amount')->sum();

        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=DB::table('incomes')
            ->whereBetween('created_at',[$from,$to])
            ->where('category_id',$taksId)
            ->whereIn('local_id',$locals_id)
            ->pluck('amount')->sum();

        return view('districts.reports.range',compact('from','to','date','yearTotal','locals','incomeTotal','taksId'));
    }

}
