<?php

namespace App\Http\Controllers\National;

use App\Http\Controllers\Controller;
use App\income;
use App\incomeCategory;
use Illuminate\Http\Request;
use App\Area;
use App\District;
use App\Locals;
use App\PostTithe;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class NationalFinanceDistrictController extends Controller
{
    public  function __construct()
    {
        date_default_timezone_set("Africa/Accra");
    }

    public function index($id){
        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $day=Carbon::now()->day;
        Session(['financeDisAll'=>$id]);
        $date=Carbon::now()->format('jS F,Y');

       $districts=District::where('area_id',$id)->get();

        $regionName=Area::findOrFail($id);

        $districtId=District::where('area_id',$id)->pluck('id')->all();

        $localId=Locals::whereIn('district_id',$districtId)->pluck('id')->all();

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

        return view('headquarters.districtTithe.index',compact(

            'districts','year','month','day','id','date','regionName','yearTotal','incomeTotal'


        ));
    }

    public function store(Request $request)
    {
        $year = Carbon::parse($request['date'])->year;
        $month = Carbon::parse($request['date'])->month;
        $day = Carbon::parse($request['date'])->day;

        $id = $request['id'];
        $date = Carbon::parse($request['date'])->format('jS F,Y');

        $districts=District::where('area_id',$id)->get();

        $regionName=Area::findOrFail($id);

        $districtId=District::where('area_id',$id)->pluck('id')->all();

        $localId=Locals::whereIn('district_id',$districtId)->pluck('id')->all();

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

        return view('headquarters.districtTithe.index', compact(
            'yearTotal', 'districts', 'year', 'month', 'day', 'id', 'date', 'regionName','incomeTotal'));
    }

    public function montharea($id){

        $year=Carbon::now()->year;

        $month=Carbon::now()->month;

        $date=Carbon::now()->format('F,Y');

        Session(['districtMonthId'=>$id]);

        $districts=District::where('area_id',$id)->get();

        $regionName=Area::findOrFail($id);

        $districtId=District::where('area_id',$id)->pluck('id')->all();

        $localId=Locals::whereIn('district_id',$districtId)->pluck('id')->all();

        $yearTotal=PostTithe::whereIn('local_id',$localId)->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->pluck('amount')->sum();
        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=income::where('category_id',$taksId)->whereIn('local_id',$localId)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at', $year)
            ->pluck('amount')->sum();

        return view('headquarters.districtTithe.month',compact(
            'districts','year','month','id','date','regionName','yearTotal','incomeTotal'));
    }

    public function store2(Request $request){

        $month=$request['month'];
        $year=$request['year'];

        $date=Carbon::parse('01'.'-'.$month.'-'.$year)->format('F,Y');

        $id=$request['id'];
        $districts=District::where('area_id',$id)->get();

        $regionName=Area::findOrFail($id);

        $districtId=District::where('area_id',$id)->pluck('id')->all();

        $localId=Locals::whereIn('district_id',$districtId)->pluck('id')->all();

        $yearTotal=PostTithe::whereIn('local_id',$localId)->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->pluck('amount')->sum();
        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=income::where('category_id',$taksId)->whereIn('local_id',$localId)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at', $year)
            ->pluck('amount')->sum();


        return view('headquarters.districtTithe.month',compact(
            'districts','year','month','id','date','regionName','yearTotal','incomeTotal'));
    }


    public function range($id){

        $date1=Carbon::now()->previousWeekendDay();

        $date2=Carbon::now();
        Session(['financeRisAll2'=>$id]);

        $date=Carbon::parse($date1)->format('jS F,Y'). ' ' . ' To ' .Carbon::parse($date2)->format('jS F,Y');

        $districts=District::where('area_id',$id)->get();

        $regionName=Area::findOrFail($id);

        $districtId=District::where('area_id',$id)->pluck('id')->all();

        $localId=Locals::whereIn('district_id',$districtId)->pluck('id')->all();

        $yearTotal=PostTithe::whereIn('local_id',$localId)->whereBetween('created_at', [$date1,$date2])
            ->pluck('amount')->sum();
        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=income::where('category_id',$taksId)->whereIn('local_id',$localId)
            ->whereBetween('created_at', [$date1,$date2])->pluck('amount')->sum();

        return view('headquarters.districtTithe.range',compact(
            'districts', 'date','date2','id','date1',
               'regionName','incomeTotal','yearTotal'));
    }

    public function store3(Request $request){

        $date1=$request['date1'];

        $date2=$request['date2'];

        $id=$request['id'];

        $date=Carbon::parse($date1)->format('jS F,Y'). ' ' . ' To ' .Carbon::parse($date2)->format('jS F,Y');

        $districts=District::where('area_id',$id)->get();

        $regionName=Area::findOrFail($id);

        $districtId=District::where('area_id',$id)->pluck('id')->all();

        $localId=Locals::whereIn('district_id',$districtId)->pluck('id')->all();

        $yearTotal=PostTithe::whereIn('local_id',$localId)->whereBetween('created_at', [$date1,$date2])
            ->pluck('amount')->sum();
        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=income::where('category_id',$taksId)->whereIn('local_id',$localId)
            ->whereBetween('created_at', [$date1,$date2])->pluck('amount')->sum();

        return view('headquarters.districtTithe.range',compact('districts',

            'date','date2','id','date1',
            'regionName','yearTotal','incomeTotal'));

    }



    public function yeararea($id){

        $year=Carbon::now()->year;

        $date=$year;

        Session(['districtYearlyId'=>$id]);

        $areas=Area::where('region_id',$id)->get();

        $districts=District::where('area_id',$id)->get();

        $regionName=Area::findOrFail($id);

        $districtId=District::where('area_id',$id)->pluck('id')->all();

        $localId=Locals::whereIn('district_id',$districtId)->pluck('id')->all();

        $yearTotal=PostTithe::whereIn('local_id',$localId)
            ->whereYear('created_at', $year)
            ->pluck('amount')->sum();
        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=income::where('category_id',$taksId)->whereIn('local_id',$localId)
            ->whereYear('created_at', $year)
            ->pluck('amount')->sum();


        return view('headquarters.districtTithe.year',compact('districts','areas','year','id','date','regionName','yearTotal','incomeTotal'));
    }

    public function yearareapost(Request $request){

        $year=$request['year'];

        $date=$request['year'];

        $id=$request['id'];

        $areas=Area::where('region_id',$id)->get();

        $districts=District::where('area_id',$id)->get();

        $regionName=Area::findOrFail($id);

        $districtId=District::where('area_id',$id)->pluck('id')->all();

        $localId=Locals::whereIn('district_id',$districtId)->pluck('id')->all();

        $yearTotal=PostTithe::whereIn('local_id',$localId)
            ->whereYear('created_at', $year)
            ->pluck('amount')->sum();
        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=income::where('category_id',$taksId)->whereIn('local_id',$localId)
            ->whereYear('created_at', $year)
            ->pluck('amount')->sum();
        return view('headquarters.districtTithe.year',compact(
            'districts','areas','year','id','date','regionName','yearTotal','incomeTotal'));
    }

}
