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

class NationalFinanceAreaController extends Controller
{
      public  function __construct()
        {
            date_default_timezone_set("Africa/Accra");
        }

        public function index($id){
            $year=Carbon::now()->year;
            $month=Carbon::now()->month;
            $day=Carbon::now()->day;

            Session(['financeDailyAreaId'=>$id]);

            $date=Carbon::now()->format('jS F,Y');

           $areas=Area::where('region_id',$id)->get();

           $regionName=Region::findOrFail($id);

           $areasId=Area::where('region_id',$id)->pluck('id')->all();

          $districtId=District::whereIn('area_id',$areasId)->pluck('id')->all();

          $localId=Locals::whereIn('district_id',$districtId)->pluck('id');

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

         return view('headquarters.areaTithe.index',compact(

             'areas','year','month','day','id','date',
                     'regionName','yearTotal','incomeTotal'));
        }

    public function indexpost(Request $request){
        $year=Carbon::parse($request['date'])->year;
        $month=Carbon::parse($request['date'])->month;
        $day=Carbon::parse($request['date'])->day;

        $id=$request['id'];
        $date=Carbon::parse($request['date'])->format('jS F,Y');

        $areas=Area::where('region_id',$id)->get();
        $regionName=Region::findOrFail($id);

        $areasId=Area::where('region_id',$id)->pluck('id')->all();

        $districtId=District::whereIn('area_id',$areasId)->pluck('id')->all();

        $localId=Locals::whereIn('district_id',$districtId)->pluck('id');

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

        return view('headquarters.areaTithe.index',compact(
            'areas','year','month','day',
            'id','date','regionName','incomeTotal','yearTotal'));
    }

    public function montharea($id){

        $year=Carbon::now()->year;
        $month=Carbon::now()->month;

        $date=Carbon::now()->format('F,Y');
        Session(['financeDisMll'=>$id]);
        $areas=Area::where('region_id',$id)->get();

        $regionName=Region::findOrFail($id);

        $areasId=Area::where('region_id',$id)->pluck('id')->all();

        $districtId=District::whereIn('area_id',$areasId)->pluck('id')->all();

        $localId=Locals::whereIn('district_id',$districtId)->pluck('id');

        $yearTotal=PostTithe::whereIn('local_id',$localId)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at', $year)
            ->pluck('amount')->sum();

        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=income::whereIn('local_id',$localId)->where('category_id',$taksId)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at', $year)
            ->pluck('amount')->sum();

        return view('headquarters.areaTithe.month',compact(
            'areas','year','month','id','date','regionName',
            'yearTotal','incomeTotal'));
    }

    public function monthareapost(Request $request){

        $month=$request['month'];
        $year=$request['year'];

        $date=Carbon::parse('01'.'-'.$month.'-'.$year)->format('F,Y');

        $id=$request['id'];
        $areas=Area::where('region_id',$id)->get();

        $regionName=Region::findOrFail($id);

        $areasId=Area::where('region_id',$id)->pluck('id')->all();

        $districtId=District::whereIn('area_id',$areasId)->pluck('id')->all();

        $localId=Locals::whereIn('district_id',$districtId)->pluck('id');

        $yearTotal=PostTithe::whereIn('local_id',$localId)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at', $year)
            ->pluck('amount')->sum();
        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=income::where('category_id',$taksId)->whereIn('local_id',$localId)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at', $year)
            ->pluck('amount')->sum();

        return view('headquarters.areaTithe.month',compact(
            'areas','year','month','id','date',
            'regionName','yearTotal','incomeTotal'));
    }


    public function range($id){

        $date1=Carbon::now()->previousWeekendDay();

        $date2=Carbon::now();

        Session(['financeRisAll'=>$id]);

        $date=Carbon::parse($date1)->format('jS F,Y'). ' ' . ' To ' .Carbon::parse($date2)->format('jS F,Y');

        $areas=Area::where('region_id',$id)->get();

        $regionName=Region::findOrFail($id);

        $areasId=Area::where('region_id',$id)->pluck('id')->all();

        $districtId=District::whereIn('area_id',$areasId)->pluck('id')->all();

        $localId=Locals::whereIn('district_id',$districtId)->pluck('id');

        $yearTotal=PostTithe::whereBetween('created_at', [$date1,$date2])->whereIn('local_id',$localId)
            ->pluck('amount')->sum();

        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=income::where('category_id',$taksId)->whereIn('local_id',$localId)
            ->whereBetween('created_at', [$date1,$date2])
            ->pluck('amount')->sum();

        return view('headquarters.areaTithe.range',compact(
            'areas','date','date2','id','date1',
            'regionName','yearTotal','incomeTotal'));
    }

    public function rangepost(Request $request){
        $date1=$request['date1'];
        $date2=$request['date2'];
        $id=$request['id'];

        $date=Carbon::parse($date1)->format('jS F,Y'). ' ' . ' To ' .Carbon::parse($date2)->format('jS F,Y');
        $areas=Area::where('region_id',$id)->get();

        $regionName=Region::findOrFail($id);

        $areasId=Area::where('region_id',$id)->pluck('id')->all();

        $districtId=District::whereIn('area_id',$areasId)->pluck('id')->all();

        $localId=Locals::whereIn('district_id',$districtId)->pluck('id');

        $yearTotal=PostTithe::whereBetween('created_at', [$date1,$date2])->whereIn('local_id',$localId)
            ->pluck('amount')->sum();

        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=income::where('category_id',$taksId)->whereIn('local_id',$localId)
            ->whereBetween('created_at', [$date1,$date2])
            ->pluck('amount')->sum();

        return view('headquarters.areaTithe.range',compact(
            'areas','date','date2','id','date1',
            'regionName','yearTotal','incomeTotal'));
    }



    public function yeararea($id){

        $year=Carbon::now()->year;

        $date=$year;
        Session(['financeDisMll2'=>$id]);

        $areas=Area::where('region_id',$id)->get();

        $regionName=Region::findOrFail($id);

        $areasId=Area::where('region_id',$id)->pluck('id')->all();

        $districtId=District::whereIn('area_id',$areasId)->pluck('id')->all();

        $localId=Locals::whereIn('district_id',$districtId)->pluck('id');

        $yearTotal=PostTithe::whereYear('created_at', $year)->whereIn('local_id',$localId)
            ->pluck('amount')->sum();

        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=income::where('category_id',$taksId)->whereIn('local_id',$localId)
            ->whereYear('created_at', $year)
            ->pluck('amount')->sum();

        return view('headquarters.areaTithe.year',compact(
            'areas','year','id','date','regionName','incomeTotal','yearTotal'));
    }

    public function yearareapost(Request $request){

        $year=$request['year'];

        $date=$request['year'];

        $id=$request['id'];
        $areas=Area::where('region_id',$id)->get();

        $regionName=Region::findOrFail($id);

        $areasId=Area::where('region_id',$id)->pluck('id')->all();

        $districtId=District::whereIn('area_id',$areasId)->pluck('id')->all();

        $localId=Locals::whereIn('district_id',$districtId)->pluck('id');


        $yearTotal=PostTithe::whereYear('created_at', $year)->whereIn('local_id',$localId)
            ->pluck('amount')->sum();

        $taksId=incomeCategory::where('name','Thanksgiving Offering')->where('local_id',0)->pluck('id');

        $incomeTotal=income::where('category_id',$taksId)->whereIn('local_id',$localId)
            ->whereYear('created_at', $year)
            ->pluck('amount')->sum();

        return view('headquarters.areaTithe.year',compact(
            'areas','year','id','date','regionName',
            'yearTotal','incomeTotal'));
    }


}
