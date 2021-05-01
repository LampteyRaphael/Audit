<?php

namespace App\Http\Controllers\Area;

use App\Area;
use App\AreaIncomeCategory;
use App\Attendance;
use App\District;
use App\Http\Controllers\Controller;
use App\incomeCategory;
use App\Locals;
use App\PostTithe;
use Carbon\Carbon;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AreaPostedChartController extends Controller
{
    //daily tithe and thanksgiving
    public function index(){
        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $day=Carbon::now()->day;

        $area_id=Auth::user()->area_id;

        $id=$area_id;

        $districtId=District::where('area_id',$area_id)->pluck('id');

        $date=Carbon::now()->format('jS F,Y');

        $districts=District::where('area_id',$area_id)->get();

        $regionName=Auth::user()->area->name;

        $localId=Locals::whereIn('district_id',$districtId)->pluck('id')->all();

        $yearTotal=PostTithe::whereIn('local_id',$localId)
            ->whereDay('created_at',$day)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

           $incomeTotal=DB::table('incomes')->where('category_id',$taksId)
               ->whereDay('created_at',$day)
           ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->whereIn('local_id',$localId)->pluck('amount')->sum();

        return view('area.chart.titheDailyChat',compact('districts','year','month','day','id','date','regionName','yearTotal','incomeTotal','taksId'));
    }


    //daily tithe and thanksgiving change of date
    public function store(Request $request){

        $year=Carbon::parse($request['date'])->year;
        $month=Carbon::parse($request['date'])->month;
        $day=Carbon::parse($request['date'])->day;


        $area_id=Auth::user()->area_id;

        $districtId=District::where('area_id',$area_id)->pluck('id');

        $date=Carbon::parse($day.'-'.$month.'-'.$year)->format('jS F,Y');

        $districts=District::where('area_id',$area_id)->get();

        $regionName=Auth::user()->area->name;

        $localId=Locals::whereIn('district_id',$districtId)->pluck('id')->all();

        $yearTotal=PostTithe::whereIn('local_id',$localId)
            ->whereDay('created_at',$day)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=DB::table('incomes')->where('category_id',$taksId)
            ->whereDay('created_at',$day)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->whereIn('local_id',$localId)->pluck('amount')->sum();

        return view('area.chart.titheDailyChat',compact('districts','year','month','day','date','regionName','yearTotal','incomeTotal','taksId'));
    }


    //monthly tithe and thanksgiving details
    public function monthly()
    {
        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $area_id=Auth::user()->area_id;

        $districtId=District::where('area_id',$area_id)->pluck('id');

        $date=Carbon::now()->format('F,Y');

        $districts=District::where('area_id',$area_id)->get();

        $regionName=Auth::user()->area->name;

        $localId=Locals::whereIn('district_id',$districtId)->pluck('id')->all();

        $yearTotal=PostTithe::whereIn('local_id',$localId)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=DB::table('incomes')->where('category_id',$taksId)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->whereIn('local_id',$localId)->pluck('amount')->sum();

        return view('area.chart.titheMonthly',compact('districts','year','month','date','regionName','yearTotal','incomeTotal','taksId'));

    }


    //monthly change of date
    public function monthlypost(Request $request)
    {
        $month=$request['month'];
        $year=$request['year'];
        $date=Carbon::parse('01'.'-'.$month.'-'.$year)->format('F,Y');

        $area_id=Auth::user()->area_id;
        $districtId=District::where('area_id',$area_id)->pluck('id');

        $districts=District::where('area_id',$area_id)->get();

        $regionName=Auth::user()->area->name;

        $localId=Locals::whereIn('district_id',$districtId)->pluck('id')->all();

        $yearTotal=PostTithe::whereIn('local_id',$localId)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=DB::table('incomes')->where('category_id',$taksId)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->whereIn('local_id',$localId)->pluck('amount')->sum();

        return view('area.chart.titheMonthly',compact('districts','year','month','date','regionName','yearTotal','incomeTotal','taksId'));

    }


    //yearly tithe and thanksgiving from locals that fall under the area
    public function year(){
        $year=Carbon::now()->year;
        $id=Auth::user()->area_id;
        $date=$year;

        $area_id=Auth::user()->area_id;

        $districtId=District::where('area_id',$area_id)->pluck('id');

        $districts=District::where('area_id',$area_id)->get();

        $regionName=Auth::user()->area->name;

        $localId=Locals::whereIn('district_id',$districtId)->pluck('id')->all();

        $yearTotal=PostTithe::whereIn('local_id',$localId)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=DB::table('incomes')->where('category_id',$taksId)
            ->whereYear('created_at',$year)
            ->whereIn('local_id',$localId)->pluck('amount')->sum();

        return view('area.chart.titheYear',compact('id','districts','year','date','regionName','yearTotal','incomeTotal','taksId'));
    }

    //changing year under thanksgiving
    public function yearpost(Request $request){
        $id=Auth::user()->area_id;
        $year=$request['year'];

        $date=$request['year'];

        $area_id=Auth::user()->area_id;

        $districtId=District::where('area_id',$area_id)->pluck('id');

        $districts=District::where('area_id',$area_id)->get();

        $regionName=Auth::user()->area->name;

        $localId=Locals::whereIn('district_id',$districtId)->pluck('id')->all();

        $yearTotal=PostTithe::whereIn('local_id',$localId)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=DB::table('incomes')->where('category_id',$taksId)
            ->whereYear('created_at',$year)
            ->whereIn('local_id',$localId)->pluck('amount')->sum();

        return view('area.chart.titheYear',compact('id','districts','year','date','regionName','yearTotal','incomeTotal','taksId'));
    }

    //selecting range of tithe and thanksgiving
    public function range(){

        $id=Auth::user()->area_id;

        $date1=Carbon::now()->previousWeekendDay();

        $date2=Carbon::now();

        $date=Carbon::parse($date1)->format('jS F,Y'). ' ' . ' To ' .Carbon::parse($date2)->format('jS F,Y');

        $area_id=Auth::user()->area_id;

        $districtId=District::where('area_id',$area_id)->pluck('id');

        $districts=District::where('area_id',$area_id)->get();

        $regionName=Auth::user()->area->name;

        $localId=Locals::whereIn('district_id',$districtId)->pluck('id')->all();

        $yearTotal=PostTithe::whereIn('local_id',$localId)
            ->whereBetween('created_at', [$date1,$date2])
            ->pluck('amount')->sum();

        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=DB::table('incomes')->where('category_id',$taksId)
            ->whereBetween('created_at', [$date1,$date2])
            ->whereIn('local_id',$localId)->pluck('amount')->sum();

        return view('area.chart.range',compact('date1','date2','id','districts','date','regionName','yearTotal','incomeTotal','taksId'));
    }

    //changing range of tithe posted under tithe and thanksgiving
    public function yrangepost(Request $request){
        $date1=$request['date1'];

        $date2=$request['date2'];

        $id=$request['id'];

        $date=Carbon::parse($date1)->format('jS F,Y'). ' ' . ' To ' .Carbon::parse($date2)->format('jS F,Y');

        $area_id=Auth::user()->area_id;

        $districtId=District::where('area_id',$area_id)->pluck('id');

        $districts=District::where('area_id',$area_id)->get();

        $regionName=Auth::user()->area->name;

        $localId=Locals::whereIn('district_id',$districtId)->pluck('id')->all();

        $yearTotal=PostTithe::whereIn('local_id',$localId)
            ->whereBetween('created_at', [$date1,$date2])
            ->pluck('amount')->sum();

        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=DB::table('incomes')->where('category_id',$taksId)
            ->whereBetween('created_at', [$date1,$date2])
            ->whereIn('local_id',$localId)->pluck('amount')->sum();

        return view('area.chart.range',compact('date1','date2','id','districts','date','regionName','yearTotal','incomeTotal','taksId'));

    }

    //tithe and thanksgiving for the year level of locals
    public  function index2($id){
        $DistrictName=District::findOrFail($id);

        $date=Carbon::now()->format('jS F,Y');

        $day=Carbon::now()->day;
        $month=Carbon::now()->month;
        $year=Carbon::now()->year;

        $locals=Locals::where('district_id',$id)->get();

        $localID=Locals::where('district_id',$id)->pluck('id')->all();


        $yearTotal=PostTithe::whereIn('local_id',$localID)
            ->whereDay('created_at',$day)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=DB::table('incomes')->where('category_id',$taksId)
            ->whereDay('created_at',$day)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->whereIn('local_id',$localID)->pluck('amount')->sum();

        return view('area.chart.tithDailyLocal',compact('id','year','month','day','date','locals','yearTotal','DistrictName','taksId','incomeTotal'));

    }

    //tithe and thanksgiving under locals change of date
    public  function store2(Request $request){

        $id=$request['id'];

        $DistrictName=District::findOrFail($id);

        $date=Carbon::parse($request['date'])->format('jS F,Y');

        $day=Carbon::parse($request['date'])->day;
        $month=Carbon::parse($request['date'])->month;
        $year=Carbon::parse($request['date'])->year;

        $locals=Locals::where('district_id',$id)->get();

        $localID=Locals::where('district_id',$id)->pluck('id')->all();

        $yearTotal=PostTithe::whereIn('local_id',$localID)
            ->whereDay('created_at',$day)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=DB::table('incomes')->where('category_id',$taksId)
           ->whereDay('created_at',$day)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->whereIn('local_id',$localID)->pluck('amount')->sum();

        return view('area.chart.tithDailyLocal',compact('id','year','month','day','date','locals','yearTotal','DistrictName','taksId','incomeTotal'));

    }


    public function yearL($id){
        $DistrictName=District::findOrFail($id);

        $date=Carbon::now()->format('Y');

        $year=Carbon::now()->year;

        $locals=Locals::where('district_id',$id)->get();

        $localID=Locals::where('district_id',$id)->pluck('id')->all();


        $yearTotal=PostTithe::whereIn('local_id',$localID)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=DB::table('incomes')->where('category_id',$taksId)
            ->whereYear('created_at',$year)
            ->whereIn('local_id',$localID)->pluck('amount')->sum();
        return view('area.chart.yearLocal',compact('id','year','date','locals','yearTotal','DistrictName','taksId','incomeTotal'));
    }

    public function yearpostL(Request $request){

         $id=$request['id'];

         $year=$request['year'];
        $DistrictName=District::findOrFail($id);

        $date=$request['year'];

        $locals=Locals::where('district_id',$id)->get();

        $localID=Locals::where('district_id',$id)->pluck('id')->all();


        $yearTotal=PostTithe::whereIn('local_id',$localID)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=DB::table('incomes')->where('category_id',$taksId)

            ->whereYear('created_at',$year)
            ->whereIn('local_id',$localID)->pluck('amount')->sum();

        return view('area.chart.yearLocal',compact('id','year','date','locals','yearTotal','DistrictName','taksId','incomeTotal'));

     }

     //local level
    public function locals($id){
        $DistrictName=District::findOrFail($id);

        $date=Carbon::now()->format('F,Y');

        $month=Carbon::now()->month;
        $year=Carbon::now()->year;

        $locals=Locals::where('district_id',$id)->get();

        $localID=Locals::where('district_id',$id)->pluck('id')->all();


        $yearTotal=PostTithe::whereIn('local_id',$localID)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=DB::table('incomes')->where('category_id',$taksId)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->whereIn('local_id',$localID)->pluck('amount')->sum();

        return view('area.chart.titheMonthlyLocal',compact('id','month','year','taksId','DistrictName','date','locals','yearTotal','incomeTotal'));

    }

    //local level post
    public function localspost(Request $request){

        $id=Auth::user()->district_id;
        $DistrictName=District::findOrFail($id);

        $date=Carbon::now()->format('F,Y');

        $month=$request['month'];
        $year=$request['year'];

        $locals=Locals::where('district_id',$id)->get();

        $localID=Locals::where('district_id',$id)->pluck('id')->all();


        $yearTotal=PostTithe::whereIn('local_id',$localID)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();

        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=DB::table('incomes')->where('category_id',$taksId)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->whereIn('local_id',$localID)->pluck('amount')->sum();

        return view('area.chart.titheMonthlyLocal',compact('id','month','year','taksId','DistrictName','date','locals','yearTotal','incomeTotal'));

    }


public function rangeL($id){

    $DistrictName=District::findOrFail($id);

    $date1=Carbon::now()->previousWeekendDay();

    $date2=Carbon::now();

    $date=Carbon::parse($date1)->format('jS F,Y'). ' ' . ' To ' .Carbon::parse($date2)->format('jS F,Y');

    $locals=Locals::where('district_id',$id)->get();

    $localID=Locals::where('district_id',$id)->pluck('id')->all();

    $yearTotal=PostTithe::whereIn('local_id',$localID)
        ->whereBetween('created_at', [$date1,$date2])
        ->pluck('amount')->sum();

    $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

    $incomeTotal=DB::table('incomes')->where('category_id',$taksId)
        ->whereBetween('created_at', [$date1,$date2])
        ->whereIn('local_id',$localID)->pluck('amount')->sum();

    return view('area.chart.rangeL',compact('DistrictName','date','id','locals','date1','date2','yearTotal','incomeTotal','taksId'));

}

public function rangeLpost(Request $request){

    $date1=$request['date1'];

    $date2=$request['date2'];

    $id=$request['id'];
    $DistrictName=District::findOrFail($id);
    $date=Carbon::parse($date1)->format('jS F,Y'). ' ' . ' To ' .Carbon::parse($date2)->format('jS F,Y');

    $locals=Locals::where('district_id',$id)->get();

    $localID=Locals::where('district_id',$id)->pluck('id')->all();

    $yearTotal=PostTithe::whereIn('local_id',$localID)
        ->whereBetween('created_at', [$date1,$date2])
        ->pluck('amount')->sum();

    $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

    $incomeTotal=DB::table('incomes')->where('category_id',$taksId)
        ->whereBetween('created_at', [$date1,$date2])
        ->whereIn('local_id',$localID)->pluck('amount')->sum();

    return view('area.chart.rangeL',compact('DistrictName','date','id','locals','date1','date2','yearTotal','incomeTotal','taksId'));

}


    public function attendance(){
        $month1=Carbon::now()->day.'-'.Carbon::now()->month.'-'.Carbon::now()->year;

        $month2=Carbon::now();

        $category="sunday";

        $date1=Carbon::parse($month1)->format('jS F,Y');

        $date2=Carbon::parse($month2)->format('jS F,Y');

        $year=' From ' . ' ' . $date1.' ' . ' to '. $date2;

        $districtID=District::where('area_id',Auth::user()->area_id)->pluck('id');

        $localID=Locals::where('district_id',$districtID)->pluck('id');

        $post=Attendance::whereIn('local_id',$localID)->where('category',$category)
            ->whereDay('created_at',Carbon::now()->day)
            ->whereMonth('created_at',Carbon::now()->month)
            ->whereYear('created_at',Carbon::now()->year)
            ->get();

        $localName=Auth::user()->local->name;
        $category=strtoupper($category);
        $locals=Locals::whereIn('id',$localID)->pluck('name','id');

        return view('area.attendance.index',compact('post','year','month1','month2','date2','category','localName','locals'));
    }

    public function attendancepost(Request $request){

        $month1=$request['from'];

        $month2=$request['to'];

        $category=$request['category'];

        $date1=Carbon::parse($month1)->format('jS F,Y');

        $date2=Carbon::parse($month2)->format('jS F,Y');

        $year=' From ' . ' ' . $date1.' ' . ' -'. $date2;
        $districtID=District::where('area_id',Auth::user()->area_id)->pluck('id');

        $localID=Locals::where('district_id',$districtID)->pluck('id');

        $post=Attendance::whereIn('local_id',$localID)->where('category',$category)

            ->whereBetween('created_at',[$month1 ,$month2])
            ->get();

        $localName=Auth::user()->local->name;
        $category=strtoupper($category);
        $locals=Locals::where('district_id',Auth::user()->district_id)->pluck('name','id');

        return view('area.attendance.index',compact('post','month1','month2','year','category','localName','locals'));
    }

//public function transfer(){
//    //showing non active users
//
//    $districtID=District::where('area_id',Auth::user()->area_id)->pluck('id');
//
//    $localID=Locals::where('district_id',$districtID)->pluck('id');
//
//    $users = User::whereIn('local_id', $localID)->where('members_id','NOT LIKE','%'.Auth::user()->local->local_code.'%')->whereIn('role_id',[1,2,3,4,5])
//        ->where('is_active', 1)->GetLatest();
//
//    return view('area.transfer.index',compact('users'));
//}

}
